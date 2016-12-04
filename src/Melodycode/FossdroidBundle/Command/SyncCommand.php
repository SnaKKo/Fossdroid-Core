<?php

namespace Melodycode\FossdroidBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Melodycode\FossdroidBundle\Entity\Application;
use Melodycode\FossdroidBundle\Entity\Category;
use ColorThief\ColorThief;

class SyncCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('fossdroid:sync')->setDescription('Sync repository with f-droid');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $container = $this->getContainer();

        $em = $container->get('doctrine')->getManager();
        $repository_application = $em->getRepository('MelodycodeFossdroidBundle:Application');
        $repository_category = $em->getRepository('MelodycodeFossdroidBundle:Category');

        $utils = $container->get('utils');
        $logger = $container->get('logger');

        // load xml file
        $repo_xml = @simplexml_load_file($container->getParameter('melodycode_fossdroid.remote_path_repo'));

        if ($repo_xml !== false) {
            // check F-Droid xml
            if ($repo_xml->repo[0]['name'] == 'F-Droid') {
                /*
                 * Categories import
                 */

                $logger->info('*** CATEGORIES IMPORT ***');

                // unpublish all the categories
                $categories = $repository_category->findAll();
                foreach ($categories as $category) {
                    $category->setIsPublished(false);
                }
                $em->flush();

                $logger->info('Categories unpublished');

                $applications_xml = $repo_xml->application;

                $categories_processed = array();
                foreach ($applications_xml as $application_xml) {
                    if (!in_array($application_xml->category, $categories_processed)) {
                        $categories_processed[] = (string) $application_xml->category;

                        // check if category exists
                        $category_slug = $utils->slugify($application_xml->category);
                        $category_obj = $repository_category->find($category_slug);

                        // if exists, create it, otherwise publish it
                        if (!$category_obj) {
                            $category_obj = new Category();
                            $category_obj->setSlug($category_slug);
                            $category_obj->setName($application_xml->category);

                            $icon = $container->getParameter('melodycode_fossdroid.category_icon');
                            $icon = $icon[$category_slug];
                            if (empty($icon)) {
                                $icon = $container->getParameter('melodycode_fossdroid.category_icon_default');
                            }
                            $category_obj->setIcon($icon);

                            $em->persist($category_obj);
                            $logger->info('Category "' . $application_xml->category . '" created with slug "' . $category_slug . '"');
                        } else {
                            $logger->info('Category "' . $application_xml->category . '" published');
                        }
                        $category_obj->setIsPublished(true);
                    }
                }
                $em->flush();

                $logger->info('*** APPLICATIONS IMPORT ***');

                // unpublish all the applications
                $applications = $repository_application->findAll();
                foreach ($applications as $application) {
                    $application->setIsPublished(false);
                }
                $em->flush();

                $logger->info('Applications unpublished');

                foreach ($applications_xml as $application_xml) {
                    $application_obj = $repository_application->find($application_xml->id);

                    // if exists, update and publish it, otherwise create it
                    if (!$application_obj) {
                        $application_obj = new Application();
                        $application_obj->setId($application_xml->id);

                        // try a slug
                        $application_slug = $utils->slugify($application_xml->name);

                        // if slug already exists, try another slug
                        $application_slug_suffix = 2;

                        while ($repository_application->findBySlug($application_slug)) {
                            $application_slug .= '-' . $application_slug_suffix;
                            $application_slug_suffix++;
                        }

                        $application_obj->setSlug($application_slug);
                        $application_obj->setCreatedAt(new \DateTime($application_xml->added));
                        $em->persist($application_obj);
                        $logger->info('Application "' . $application_xml->name . '" created with slug "' . $application_slug . '"');
                    } else {
                        $logger->info('Application "' . $application_xml->name . '" updated');
                    }

                    $application_obj->setName($application_xml->name);
                    $application_obj->setSummary($application_xml->summary);
                    $application_obj->setDescription($application_xml->desc);
                    $application_obj->setSite($application_xml->web);
                    $application_obj->setSource($application_xml->source);
                    $application_obj->setTracker($application_xml->tracker);
                    $application_obj->setDonate($application_xml->donate);
                    $application_obj->setLicense($application_xml->license);

                    $application_package_xml = $application_xml->package[0];
                    $application_obj->setApk($application_package_xml->apkname);
                    $application_obj->setVersion($application_package_xml->version);
                    $application_obj->setUpdatedAt(new \DateTime($application_xml->lastupdated));

                    // set application category
                    $category_obj = $repository_category->find($utils->slugify($application_xml->category));
                    $application_obj->setCategory($category_obj);

                    // save icon
                    $application_icon_saved = $utils->download($container->getParameter('melodycode_fossdroid.remote_path_icons') . $application_xml->icon, $container->getParameter('melodycode_fossdroid.local_path_icons'));

                    if ($application_icon_saved) {
                        // extract colors
                        try {
                            $colors = ColorThief::getPalette($container->getParameter('melodycode_fossdroid.local_path_icons') . $application_xml->icon, 3);
                            $color_count = 0;
                            foreach ($colors as $color) {
                                $color_count++;
                                $r = $color[0];
                                $g = $color[1];
                                $b = $color[2];
                                $hex = '#' . sprintf('%02x', $r) . sprintf('%02x', $g) . sprintf('%02x', $b);

                                switch ($color_count) {
                                    case 1:
                                        $application_obj->setPrimaryColor($hex);
                                        break;
                                    case 2:
                                        $application_obj->setSecondaryColor($hex);
                                        break;
                                    case 3:
                                        $application_obj->setTertiaryColor($hex);
                                        break;
                                }
                            }
                        } catch (\Exception $e) {
                            $logger->error($e->getMessage());
                        }

                        $logger->info('- Icon ' . $application_xml->icon . ' saved');
                    }

                    $application_obj->setIcon($application_xml->icon);

                    $application_obj->setIsPublished(true);

                    $em->flush();
                }
            } else {
                $logger->error('Invalid XML format');
            }
        } else {
            $logger->error('XML not reachable');
        }

        // update applications count
        $categories = $repository_category->findAll();

        foreach ($categories as $category) {
            $count = $repository_application->findByPublished(0, 'created_at', $category->getSlug());
            $category->setCount(count($count));
        }
        $em->flush();

        $logger->info('Colors, count and icons updated');
    }

}
