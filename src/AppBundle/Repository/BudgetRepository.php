<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 10:45
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BudgetRepository extends EntityRepository
{
    public function findLastRow()
    {
        return $this->createQueryBuilder('budget')
            ->orderBy('budget.id', 'DESC')
            ->setMaxResults( 1 )
            ->getQuery()
            ->execute();
    }
}