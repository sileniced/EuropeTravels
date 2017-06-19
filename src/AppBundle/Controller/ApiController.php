<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 25-5-2017
 * Time: 23:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Hash;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/new/payment", name="payment")
     * @Method("POST")
     * @return Response
     */
    public function NewPaymentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\PaymentFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('payment', 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @Route("/new/document", name="document")
     * @Method("POST")
     * @return Response
     */
    public function NewDocumentAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\DocumentFormType')->handleRequest($request);
        if ($form->isValid()) {

            return new Response('document', 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param Request $request
     * @param $_object
     * @return Response
     * @Route("/new/{_object}", name="new")
     * @Method("POST")
     */
    public function NewAction(Request $request, $_object)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('AppBundle\Form\\' . $_object . 'FormType')->handleRequest($request);
        if ($form->isValid()) {
            $object = $form->getData();

            foreach ($object->getDocuments() as $document) {
                $hash = $this->documentUploader($document->getDocument());
                $document->setDocumentPath($hash);
            }

            $em->persist($object);
            $em->flush();

            return new Response($_object, 200);
        }

        return new Response(null, 500);
    }

    /**
     * @Route("/payment-status", name="PaymentStatus")
     * @param Request $request
     * @return Response
     */
    public function paymentStatusChangeAction(Request $request)
    {
        $bag = $request->request;
        $em = $this->getDoctrine()->getManager();

        $object = $em->getRepository('AppBundle:PaymentStatus')
            ->find($bag->get('id'));

        $object->setPaymentStatus($bag->get('paymentStatus'));

        $em->merge($object);
        $em->flush();

        return new Response(null, 204);
    }

    /**
     * @param $file
     * @return string
     */
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