<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 29-5-2017
 * Time: 22:12
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PaymentStatusRepository extends EntityRepository
{
    public function findGroupedByStatus() {
        return $this->createQueryBuilder('payment_status')
            ->orderBy('payment_status.paymentStatus', 'ASC')
            ->getQuery()
            ->execute();
    }
}