<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $fixer = $this->get('app.get_exchange_rates')->getExchangeRates();

        $em = $this->getDoctrine()->getManager();

        return $this->render('default/index.html.twig', [
            'collection' => [
                'transports' =>     $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
                'hotels' =>         $em->getRepository('AppBundle:Hotel')->findAllOrderedByStartsAt(),
                'attractions' =>    $em->getRepository('AppBundle:Attraction')->findAllOrderedByStartsAt(),
            ],
            'documents' =>          $em->getRepository('AppBundle:Document')->findAll(),
            'itinerary' =>          $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt(),
            'payments' =>           $em->getRepository('AppBundle:Payment')->findAll(),
            'paymentStatus' =>      $this->get('app.generate_payment_status_list')->generate($fixer),
            'budget' => [
                'budget' =>         $this->get('app.get_budget')->generate($fixer),
                'history' =>        $em->getRepository('AppBundle:Budget')->findDesc(),
            ],
            'forms' => [
                'document' =>       $this->createForm('AppBundle\Form\DocumentEmbeddedForm')->createView(),
                'transport' =>      $this->createForm('AppBundle\Form\TransportFormType')->createView(),
                'hotel' =>          $this->createForm('AppBundle\Form\HotelFormType')->createView(),
                'attraction'=>      $this->createForm('AppBundle\Form\AttractionFormType')->createView(),
                'payment'=>         $this->createForm('AppBundle\Form\PaymentFormType')->createView()
            ],
            'fixer' =>              $fixer,
            'variables' =>          $this->get('app.get_variables'),
            'antshares' =>          $this->get('app.antshares_to_euros')->getPrice()
        ]);
    }
}
