<?php

namespace Melodycode\FossdroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomepageController extends Controller {

    public function indexAction() {
        return $this->render('MelodycodeFossdroidBundle:Homepage:index.html.twig');
    }

}
