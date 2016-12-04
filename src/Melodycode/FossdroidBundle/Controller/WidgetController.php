<?php

namespace Melodycode\FossdroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WidgetController extends Controller {

    public function whatsnewAction(Request $request) {
        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Application');
        $applications = $repository->findByPublished($this->container->getParameter('melodycode_fossdroid.widget_limit'), 'created_at', $request->get('slug_selected'));

        return $this->render('MelodycodeFossdroidBundle:Widget:whatsnew.html.twig', array(
                    'applications' => $applications,
                    'category_slug' => $request->get('slug_selected')
                        )
        );
    }

    public function categoriesAction(Request $request) {
        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Category');
        $categories = $repository->findBy(array('is_published' => 1), array('count' => 'DESC'));

        return $this->render('MelodycodeFossdroidBundle:Widget:categories.html.twig', array(
                    'categories' => $categories,
                    'slug_selected' => $request->get('slug_selected')
                        )
        );
    }

    public function searchAction(Request $request) {
        return $this->render('MelodycodeFossdroidBundle:Widget:search.html.twig', array(
                    'q' => $request->get('q')
                        )
        );
    }

}
