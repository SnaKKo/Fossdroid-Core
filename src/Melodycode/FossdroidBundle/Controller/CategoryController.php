<?php

namespace Melodycode\FossdroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller {

    public function indexAction($slug) {
        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Category');
        $category = $repository->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('The category does not exist');
        }

        return $this->render('MelodycodeFossdroidBundle:Category:index.html.twig', array(
                    'category' => $category
        ));
    }

    public function whatsnewAction($slug) {
        $repository_category = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Category');
        $category = $repository_category->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('The category does not exist');
        }

        $repository_application = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Application');
        $applications = $repository_application->findByPublished(0, 'created_at', $slug);

        return $this->render('MelodycodeFossdroidBundle:Category:whatsnew.html.twig', array(
                    'category' => $category,
                    'applications' => $applications
        ));
    }

}
