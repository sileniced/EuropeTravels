<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 23-5-2017
 * Time: 14:02
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TransportRepository extends EntityRepository
{
    public function findAllOrderedByStartsAt()
    {
        return $this->createQueryBuilder('transport')
            ->join('transport.itinerary', 'itinerary')
            ->orderBy('itinerary.startsAt', 'ASC')
            ->getQuery()
            ->execute();
    }
}