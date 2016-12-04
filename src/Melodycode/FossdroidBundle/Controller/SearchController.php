<?php

namespace Melodycode\FossdroidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SearchController extends Controller {

    public function indexAction() {
        $q = $this->getRequest()->query->get('q');
        
        $utils = $this->get('utils');
        $terms = $utils->terms($q);

        $q = implode(' ', $terms);

        if (empty($terms)) {
            return new RedirectResponse($this->generateUrl('homepage'));
        }

        $repository = $this->getDoctrine()->getRepository('MelodycodeFossdroidBundle:Application');
        $queryBuilder = $repository->createQueryBuilder('a');

        $query = $queryBuilder->where('a.is_published = 1');

        // build search query

        $conditions = array();
        foreach ($terms as $term) {
            $conditions_like = array();
            $conditions_like[] = $queryBuilder->expr()->like('a.name', $queryBuilder->expr()->literal('%' . $term . '%'));
            $conditions_like[] = $queryBuilder->expr()->like('a.summary', $queryBuilder->expr()->literal('%' . $term . '%'));
            $conditions_like[] = $queryBuilder->expr()->like('a.description', $queryBuilder->expr()->literal('%' . $term . '%'));

            $conditions[] = $queryBuilder->expr()->orX()->addMultiple($conditions_like);
        }

        $query = $query->andWhere($queryBuilder->expr()->andX()->addMultiple($conditions))
                ->getQuery();

        $result = $query->getResult();

        return $this->render('MelodycodeFossdroidBundle:Search:index.html.twig', array(
                    'q' => $q,
                    'applications' => $result
        ));
    }

}
