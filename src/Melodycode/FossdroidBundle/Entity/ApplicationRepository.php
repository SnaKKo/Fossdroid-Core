<?php

namespace Melodycode\FossdroidBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ApplicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApplicationRepository extends EntityRepository {

    public function findByPublished($limit, $order_by, $slug_selected) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQueryBuilder()
                ->select('a')
                ->from('MelodycodeFossdroidBundle:Application', 'a')
                ->where('a.is_published = 1');

        if ($slug_selected) {
            $query->andWhere('a.category = :category_slug');
            $query->setParameter('category_slug', $slug_selected);
        }

        $query->orderBy('a.' . $order_by, 'DESC');

        if ($limit) {
            $query->setMaxResults($limit);
        }

        return $query->getQuery()->getResult();
    }

}
