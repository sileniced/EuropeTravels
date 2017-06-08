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

        return $this->render('default/index.html.twig', [
            'transports' =>     $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
            'hotels' =>         $em->getRepository('AppBundle:Hotel')->findAllOrderedByStartsAt(),
            'attractions' =>    $em->getRepository('AppBundle:Attraction')->findAllOrderedByStartsAt(),
            'documents' =>      $em->getRepository('AppBundle:Document')->findAll(),
            'itinerary' =>      $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt(),
            'payments' =>       $em->getRepository('AppBundle:Payment')->findAll(),
            'paymentStatus' =>  $em->getRepository('AppBundle:PaymentStatus')->findGroupedByStatus(),
            'forms' => [
                'document' =>   $this->createForm('AppBundle\Form\DocumentFormType')->createView(),
                'transport' =>  $this->createForm('AppBundle\Form\TransportFormType')->createView(),
                'hotel' =>      $this->createForm('AppBundle\Form\HotelFormType')->createView(),
                'attraction'=>  $this->createForm('AppBundle\Form\AttractionFormType')->createView(),
                'payment'=>     $this->createForm('AppBundle\Form\PaymentFormType')->createView()
            ]
        ]);
    }
}
