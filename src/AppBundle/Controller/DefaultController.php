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
            'prepayments' =>    $em->getRepository('AppBundle:Prepayments')->findAll(),
            'transports' =>     $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
            'hotels' =>         $em->getRepository('AppBundle:Hotels')->findAllOrderedByStartsAt(),
            'attractions' =>    $em->getRepository('AppBundle:Attractions')->findAllOrderedByStartsAt(),
            'documents' =>      $em->getRepository('AppBundle:Documents')->findAll(),
            'itinerary' =>      $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt(),
            'forms' => [
                'document' =>   $this->createForm('AppBundle\Form\DocumentFormType')->createView(),
                'transport' =>  $this->createForm('AppBundle\Form\TransportFormType')->createView(),
                'hotel' =>      $this->createForm('AppBundle\Form\HotelFormType')->createView(),
                'attraction'=>  $this->createForm('AppBundle\Form\AttractionFormType')->createView(),
                'prepayment'=>  $this->createForm('AppBundle\Form\PrepaymentFormType')->createView()
            ]
        ]);
    }
}
