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
            'prepayments' => $em->getRepository('AppBundle:Prepayments')->findAll(),
            'transports' =>  $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt(),
            'hotels' =>      $em->getRepository('AppBundle:Hotels')->findAllOrderedByStartsAt(),
            'attractions' => $em->getRepository('AppBundle:Attractions')->findAllOrderedByStartsAt(),
            'documents' =>   $em->getRepository('AppBundle:Documents')->findAll(),
            'forms' => [
                'document' =>  $this->createForm('AppBundle\Form\DocumentFormType')->createView(),
                'transport' => $this->createForm('AppBundle\Form\TransportFormType')->createView()
            ]
        ]);
    }
}
