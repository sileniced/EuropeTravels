<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 25-5-2017
 * Time: 23:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Attractions;
use AppBundle\Entity\Hotels;
use AppBundle\Entity\Transport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route('/api')
 */
class ApiController extends Controller
{

    /**
     * @param Request $request
     * @Route('/transport', name="transport")
     */
    public function TransportAction(Request $request)
    {
        $transport = $this->createForm('AppBundle\Form\TransportFormType',
            new Transport())
            ->handleRequest($request);

        dump($transport);

        if ($transport->isValid()) {

        }
    }

    /**
     * @param Request $request
     * @Route('/hotel', name="hotel")
     */
    public function HotelAction(Request $request)
    {
        $hotel = $this->createForm('AppBundle\Form\HotelFormType',
            new Hotels())
            ->handleRequest($request);

        if ($hotel->isValid()) {

        }
    }
    /**
     * @param Request $request
     * @Route('/attraction', name="attraction")
     */
    public function AttractionAction(Request $request)
    {
        $attraction = $this->createForm('AppBundle\Form\AttractionFormType',
            new Attractions())
            ->handleRequest($request);

        if ($attraction->isValid()) {

        }
    }
    /**
     * @param Request $request
     * @Route('/prepayment', name="prepayment")
     */
    public function PrepaymentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\PrepaymentFormType')
            ->handleRequest($request);

        if ($form->isValid()) {

        }
    }
    /**
     * @param Request $request
     * @Route('/document', name="document")
     */
    public function DocumentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\DocumentFormType')
            ->handleRequest($request);

        if ($form->isValid()) {

        }
    }
}