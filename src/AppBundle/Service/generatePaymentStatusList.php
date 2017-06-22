<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 19-6-2017
 * Time: 15:43
 */

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class generatePaymentStatusList
{

    private $em;

    /**
     * generatePaymentStatusList constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function generate($fixer)
    {

        $paymentStatusAll = $this->em->getRepository('AppBundle:PaymentStatus')->findGroupedByStatus();

        if (!$paymentStatusAll) return null;

        $paymentStatus = [];
        $__paymentStatus = '';
        $paymentStatusCount = null;
        $paymentStatusTotal['IDR'] = 0;
        $paymentStatusTotal['EUR'] = 0;

        foreach ($paymentStatusAll as $_paymentStatus) {
            if ($_paymentStatus->getPaymentStatus() !== $__paymentStatus) {
                if ($paymentStatusCount === null) {
                    $paymentStatusCount = 0;
                } else {
                    $paymentStatus[$paymentStatusCount]['total']['IDR'] = number_format($paymentStatusTotal['IDR'], 0, '.', ',');
                    $paymentStatus[$paymentStatusCount]['total']['EUR'] = number_format($paymentStatusTotal['EUR'], 2, ',', '.');
                    $paymentStatusCount++;
                    $paymentStatusTotal['IDR'] = 0;
                    $paymentStatusTotal['EUR'] = 0;
                }
                $__paymentStatus = $_paymentStatus->getPaymentStatus();
                $paymentStatus[$paymentStatusCount]['title'] = $__paymentStatus;
            }

            $costs['base'] = $_paymentStatus->getCosts();

            switch ($_paymentStatus->getCurrency()) {
                case 'EUR':
                    $costs['IDR'] = $costs['base'] * $fixer['EUR']->IDR;
                    $_paymentStatus->setCostsIDR(\number_format($costs['IDR'], 0, '.', ','));
                    $_paymentStatus->setCostsEUR(\number_format($costs['base'], 2, ',', '.'));
                    $paymentStatusTotal['IDR'] += $costs['IDR'];
                    $paymentStatusTotal['EUR'] += $costs['base'];
                    break;
                case 'IDR':
                    $costs['EUR'] = $costs['base'] / $fixer['EUR']->IDR;
                    $_paymentStatus->setCostsIDR(\number_format($costs['base'], 0, '.', ','));
                    $_paymentStatus->setCostsEUR(\number_format($costs['EUR'], 2, ',', '.'));
                    $paymentStatusTotal['IDR'] += $costs['base'];
                    $paymentStatusTotal['EUR'] += $costs['EUR'];
                    break;
                default:
                    $costs['IDR'] = $costs['base'] * $fixer[$_paymentStatus->getCurrency()]->IDR;
                    $costs['EUR'] = $costs['base'] * $fixer[$_paymentStatus->getCurrency()]->EUR;
                    $_paymentStatus->setCostsIDR(\number_format($costs['IDR'], 0, '.', ','));
                    $_paymentStatus->setCostsEUR(\number_format($costs['EUR'], 2, ',', '.'));
                    $paymentStatusTotal['IDR'] += $costs['IDR'];
                    $paymentStatusTotal['EUR'] += $costs['EUR'];
                    break;
            }
            $paymentStatus[$paymentStatusCount]['PaymentStatus'][] = $_paymentStatus;
            unset($costs);
        }
        $paymentStatus[$paymentStatusCount]['total']['IDR'] = \number_format($paymentStatusTotal['IDR'], 0, '.', ',');
        $paymentStatus[$paymentStatusCount]['total']['EUR'] = \number_format($paymentStatusTotal['EUR'], 2, ',', '.');

        return $paymentStatus;
    }
}