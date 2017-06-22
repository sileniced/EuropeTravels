<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 11:03
 */

namespace AppBundle\Service;


use AppBundle\Entity\Budget;
use Doctrine\ORM\EntityManager;

class generateBudget
{
    private $em;

    /**
     * generateBudget constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function generate($fixer)
    {
        $_today = new \DateTime(null, new \DateTimeZone('Europe/Amsterdam'));

        $budget = $this->em->getRepository('AppBundle:Budget')->findLastRow();

        if (null == $budget) {

            $budget = new Budget();
            $budget->setAmount(6000);

            $budget->setEndDateAt(new \DateTime('2017-08-04', new \DateTimeZone('Europe/Amsterdam')));
            $budget->setCreatedAt($_today);

            $daysLeft = $_today->diff($budget->getEndDateAt());
            $budget->setAmountToday($budget->getAmount() / $daysLeft->days);
            $this->em->persist($budget);
            $this->em->flush();

        } else {

            $budget = $budget[0];

            $today = $_today->format('Y-m-d');

            $_createdAt = $budget->getCreatedAt();
            $createdAt = $_createdAt->format('Y-m-d');

            $daysLeft = $_today->diff($budget->getEndDateAt());

            if ($today > $createdAt) {

                $budget->setCreatedAt($_today);
                $budget->setAmountToday($budget->getAmount() / $daysLeft->days);

                $this->em->detach($budget);
                $this->em->persist($budget);
                $this->em->flush();

            }

        }

        $amountTomorrow = $budget->getAmount() / ($daysLeft->days - 1);

        $amount = $budget->getAmount();

        return [
            'amount' => [
                'EUR' => \number_format($amount, 2, ',', '.'),
                'IDR' => \number_format($amount * $fixer['EUR']->IDR, 0, '.', ','),
                'GBP' => \number_format($amount * $fixer['EUR']->GBP, 2, ',', '.'),
                'CZK' => \number_format($amount * $fixer['EUR']->CZK, 2, ',', '.')
            ],
            'amountToday' => [
                'EUR' => \number_format($budget->getAmountToday(), 2, ',', '.'),
                'IDR' => \number_format($budget->getAmountToday() * $fixer['EUR']->IDR, 0, '.', ','),
                'GBP' => \number_format($budget->getAmountToday() * $fixer['EUR']->GBP, 2, ',', '.'),
                'CZK' => \number_format($budget->getAmountToday() * $fixer['EUR']->CZK, 2, ',', '.')
            ],
            'amountTomorrow' => [
                'EUR' => \number_format($amountTomorrow, 2, ',', '.'),
                'IDR' => \number_format($amountTomorrow * $fixer['EUR']->IDR, 0, '.', ','),
                'GBP' => \number_format($amountTomorrow * $fixer['EUR']->GBP, 2, ',', '.'),
                'CZK' => \number_format($amountTomorrow * $fixer['EUR']->CZK, 2, ',', '.')
            ],
            'amountTodayInt' => $budget->getAmountToday(),
            'amountInt' => $budget->getAmount(),
            'daysLeft' => $daysLeft->days
        ];
    }
}