<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $buzz = $this->container->get('buzz');

        $fixer['EURIDR'] = json_decode($buzz->get('http://api.fixer.io/latest?symbols=IDR')->getContent())->rates->IDR;
        $fixer['GBP'] = json_decode($buzz->get('http://api.fixer.io/latest?base=GBP&symbols=IDR,EUR')->getContent())->rates;
        $fixer['CZK'] = json_decode($buzz->get('http://api.fixer.io/latest?base=CZK&symbols=IDR,EUR')->getContent())->rates;

        $paymentStatusAll = $em->getRepository('AppBundle:PaymentStatus')->findGroupedByStatus();

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
                    $costs['IDR'] = $costs['base'] * $fixer['EURIDR'];
                    $_paymentStatus->setCostsIDR(\number_format($costs['IDR'], 0, '.', ','));
                    $_paymentStatus->setCostsEUR(\number_format($costs['base'], 2, ',', '.'));
                    $paymentStatusTotal['IDR'] += $costs['IDR'];
                    $paymentStatusTotal['EUR'] += $costs['base'];
                    break;
                case 'IDR':
                    $costs['EUR'] = $costs['base'] / $fixer['EURIDR'];
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

        return $this->render('default/index.html.twig', [
            'transports' =>     $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
            'hotels' =>         $em->getRepository('AppBundle:Hotel')->findAllOrderedByStartsAt(),
            'attractions' =>    $em->getRepository('AppBundle:Attraction')->findAllOrderedByStartsAt(),
            'documents' =>      $em->getRepository('AppBundle:Document')->findAll(),
            'itinerary' =>      $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt(),
            'payments' =>       $em->getRepository('AppBundle:Payment')->findAll(),
            'paymentStatus' =>  $paymentStatus,
            'forms' => [
                'document' =>   $this->createForm('AppBundle\Form\DocumentEmbeddedForm')->createView(),
                'transport' =>  $this->createForm('AppBundle\Form\TransportFormType')->createView(),
                'hotel' =>      $this->createForm('AppBundle\Form\HotelFormType')->createView(),
                'attraction'=>  $this->createForm('AppBundle\Form\AttractionFormType')->createView(),
                'payment'=>     $this->createForm('AppBundle\Form\PaymentFormType')->createView()
            ],
            'fixer' => [
                'EURIDR' => $fixer['EURIDR'],
                'GBPIDR' => $fixer['GBP']->IDR,
                'GBPEUR' => $fixer['GBP']->EUR,
                'CZKIDR' => $fixer['CZK']->IDR,
                'CZKEUR' => $fixer['CZK']->EUR
            ]
        ]);
    }
}
