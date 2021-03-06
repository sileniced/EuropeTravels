<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 23-5-2017
 * Time: 14:01
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AttractionRepository extends EntityRepository
{
    public function findAllOrderedByStartsAt()
    {
        return $this->createQueryBuilder('attraction')
            ->join('attraction.itinerary', 'itinerary')
            ->orderBy('itinerary.startsAt', 'ASC')
            ->getQuery()
            ->execute();
    }
}