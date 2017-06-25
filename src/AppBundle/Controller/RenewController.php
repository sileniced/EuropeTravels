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
     * @param $list
     * @return Response
     */
    public function RenewAction($list)
    {
        $em = $this->getDoctrine()->getManager();

        $fixer = $this->get('app.get_exchange_rates')->getExchangeRates();

        switch ($list) {
            case 'payment':
                return new Response($this->renderView('renew/paymentStatusList.html.twig', [
                    'paymentStatus' =>  $this->get('app.generate_payment_status_list')->generate($fixer)
                ]), 200);
            case 'itinerary':
                return new Response($this->renderView('renew/itineraryList.html.twig', [
                    'itinerary' => $em->getRepository('AppBundle:Itinerary')->findAllOrderedByStartsAt()
                ]), 200);
            case 'transport':
                return new Response($this->renderView('renew/transportList.html.twig', [
                    'transports' => $em->getRepository('AppBundle:Transport')->findAllOrderedByStartsAt()
                ]), 200);
            case 'hotel':
                return new Response($this->renderView('renew/hotelList.html.twig', [
                    'hotels' => $em->getRepository('AppBundle:Hotel')->findAllOrderedByStartsAt(),
                ]), 200);
            case 'attraction':
                return new Response($this->renderView('renew/attractionList.html.twig', [
                    'attractions' => $em->getRepository('AppBundle:Attraction')->findAllOrderedByStartsAt(),
                ]), 200);
            case 'document':
                return new Response($this->renderView('renew/documentList.html.twig', [
                    'documents' => $em->getRepository('AppBundle:Document')->findAll()
                ]), 200);
            case 'budget':
                return new Response($this->renderView('renew/budget.html.twig', [
                    'budget' => $this->get('app.get_budget')->generate($fixer),
                    'variables' => $this->get('app.get_variables')
                ]), 200);
            case 'budget-history':
                return new Response($this->renderView('renew/budgetHistory.html.twig', [
                    'budgetHistory' => $em->getRepository('AppBundle:Budget')->findDesc(),
                ]), 200);
        }
    }
}