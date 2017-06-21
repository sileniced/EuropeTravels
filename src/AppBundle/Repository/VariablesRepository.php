<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 16:23
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class VariablesRepository extends EntityRepository
{
    public function findLastRow()
    {
        return $this->createQueryBuilder('variables')
            ->orderBy('variables.id', 'DESC')
            ->setMaxResults( 1 )
            ->getQuery()
            ->execute();
    }
}