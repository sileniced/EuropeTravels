<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 23-5-2017
 * Time: 14:01
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository
{
    public function findAllOrderedByStartsAt()
    {
        return $this->createQueryBuilder('hotel')
            ->orderBy('hotel.startsAt', 'ASC')
            ->getQuery()
            ->execute();
    }
}