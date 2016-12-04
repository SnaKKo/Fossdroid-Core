<?php

namespace Melodycode\FossdroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ApplicationController extends Controller {

    public function indexAction($slug) {
        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Application');
        $application = $repository->findOneBySlug($slug);

        if (!$application) {
            throw $this->createNotFoundException('The application does not exist');
        }

        return $this->render('MelodycodeFossdroidBundle:Application:index.html.twig', array(
                    'application' => $application,
                    'remote_browser_app' => $this->container->getParameter('melodycode_fossdroid.remote_browser_app')
        ));
    }

    public function downloadAction($slug) {
        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Application');
        $application = $repository->findOneBySlug($slug);

        if (!$application) {
            throw $this->createNotFoundException('The application does not exist');
        }

        return new RedirectResponse($this->container->getParameter('melodycode_fossdroid.remote_path_apks') . $application->getApk());
    }

}
