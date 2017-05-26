<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 25-5-2017
 * Time: 23:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Hash;
use AppBundle\Entity\Itinerary;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route("/api")
 */
class ApiController extends Controller
{

    /**
     * @param Request $request
     * @Route("/transport", name="transport")
     * @Method("POST")
     * @return Response
     */
    public function TransportAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\TransportFormType')->handleRequest($request);
        if ($form->isValid()) {
            $transport = $form->getData();

            $document = [];
            for ($i = 1; $i <= 3; $i++) {
                $getDocument = 'getDocument' . $i;
                $setDocumentPath = 'setDocumentPath' . $i;
                $getDocumentDescription = 'getDocumentDescription' . $i;

                if ($transport->$getDocument()) {
                    $hash = $this->documentUploader($transport->$getDocument());
                    $transport->$setDocumentPath($hash);
                    $document[$i] = [
                        'description' => $transport->$getDocumentDescription(),
                        'hash' => $hash
                    ];
                }
            }

            $startsAt = $transport->getStartsAt();
            $endsAt = $transport->getEndsAt();

            $itinerary = new Itinerary();
            $itinerary->setStartsAt($startsAt);
            $itinerary->setEndsAt($endsAt);
            $itinerary->setTransport($transport);

            $em = $this->getDoctrine()->getManager();
            $em->persist($transport);
            $em->persist($itinerary);
            $em->flush();

            $data = [
                'form' => 'transport',
                'documents' => $document
            ];

            return new JsonResponse($data);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @Route("/hotel", name="hotel")
     * @Method("POST")
     * @return Response
     */
    public function HotelAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\HotelFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('hotel', 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @Route("/attraction", name="attraction")
     * @Method("POST")
     * @return Response
     */
    public function AttractionAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\AttractionFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('attraction', 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @Route("/prepayment", name="prepayment")
     * @Method("POST")
     * @return Response
     */
    public function PrepaymentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\PrepaymentFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('prepayment', 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @Route("/document", name="document")
     * @Method("POST")
     * @return Response
     */
    public function DocumentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\DocumentFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('document', 200);
        }

        return new Response(null, 500);
    }

    private function documentUploader($file)
    {
        $hashGenerator = $this->get('app.hash_generator');
        $hash = $hashGenerator->generate();
        $extension = $file->getClientOriginalExtension();
        $directory = $this->getParameter('document_directory');

        $file->move($directory . '/', $hash);

        $_hash = new Hash();
        $_hash->setHash($hash);
        $_hash->setExtension($extension);

        $em = $this->getDoctrine()->getManager();
        $em->persist($_hash);
        $em->flush();

        return $hash;

    }
}