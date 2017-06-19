<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 19-6-2017
 * Time: 18:05
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route("/api/renew")
 */
class RenewController extends Controller
{
    /**
     * @Route("/{list}")
     */
    public function RenewAction($list)
    {
        $em = $this->getDoctrine()->getManager();

        switch ($list) {
            case 'payment':
                return new Response($this->renderView('renew/paymentStatusList.html.twig', [
                    'paymentStatus' =>  $this->get('app.generate_payment_status_list')->generate()['paymentStatus']
                ]), 200);
            case 'itinerary':
                return new Response($this->renderView('renew/itineraryList.html.twig', [
                    'paymentStatus' => $em->getRepository('AppBundle:Itinerary')
                        ->findAllOrderedByStartsAt()
                ]), 200);

        }
    }
}