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

        $generatePaymentStatus = $this->get('app.generate_payment_status_list')->generate();
        $fixer = $generatePaymentStatus['fixer'];

        return $this->render('default/index.html.twig', [
            'transports' =>     $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
            'hotels' =>         $em->getRepository('AppBundle:Hotel')->findAllOrderedByStartsAt(),
            'attractions' =>    $em->getRepository('AppBundle:Attraction')->findAllOrderedByStartsAt(),
            'documents' =>      $em->getRepository('AppBundle:Document')->findAll(),
            'itinerary' =>      $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt(),
            'payments' =>       $em->getRepository('AppBundle:Payment')->findAll(),
            'paymentStatus' =>  $generatePaymentStatus['paymentStatus'],
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
