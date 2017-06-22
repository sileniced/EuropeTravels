<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-6-2017
 * Time: 22:54
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findLastRow()
    {
        return $this->createQueryBuilder('user')
            ->orderBy('user.id', 'DESC')
            ->setMaxResults( 1 )
            ->getQuery()
            ->execute();
    }
}