<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 25-5-2017
 * Time: 23:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Budget;
use AppBundle\Entity\BudgetSubtraction;
use AppBundle\Entity\Document;
use AppBundle\Entity\Hash;
use AppBundle\Entity\Variables;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @Route("/new/document", name="document")
     * @Method("POST")
     * @return Response
     */
    public function NewDocumentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('AppBundle\Form\DocumentEmbeddedForm')->handleRequest($request);
        if ($form->isValid()) {
            $object = $form->getData();

            $object->setDocumentPath($this->documentUploader($object->getDocument()));
            $object->setEntity('Document');

            $em->persist($object);
            $em->flush();
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

            if (method_exists($object,'getDocuments')) {
                /** @var Document $document */
                foreach ($object->getDocuments() as $document) {
                    $document->setDocumentPath($this->documentUploader($document->getDocument()));
                }
            }

            $em->persist($object);
            $em->flush();

            return new Response($_object, 200);
        }

        return new Response(null, 500);
    }

    /**
     * @param $file
     * @return string
     */
    private function documentUploader(UploadedFile $file)
    {
        $hashGenerator = $this->get('app.hash_generator');
        $hash = $hashGenerator->generate();
        $extension = $file->getClientOriginalExtension();
        $directory = $this->getParameter('document_directory');

        $file->move($directory . '/', $hash);

        $_hash = new Hash($hash, $extension);

        $em = $this->getDoctrine()->getManager();
        $em->persist($_hash);
        $em->flush();

        return $hash;

    }


    /**
     * @Route("/budget/subtract")
     * @param Request $request
     * @return Response
     */
    public function updateBudgetAction(Request $request)
    {
        $bag = $request->request;
        $em = $this->getDoctrine()->getManager();
        $amount = $bag->get('amount');

        /** @var Budget $budget */
        $budget = $em->getRepository('AppBundle:Budget')->findLastRow()[0];
        $budget->setAmount($budget->getAmount() - $amount);
        $budget->setAmountToday($budget->getAmountToday() - $amount);

        $budgetSubtraction = new BudgetSubtraction($amount, $bag->get('description'), $budget);
        
        $em->persist($budget);
        $em->persist($budgetSubtraction);
        $em->flush();

        return new Response(null, 204);
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
     * @Route("/converter/{currency}")
     * @param $currency
     * @return Response
     */
    public function rememberConverterBaseCurrency($currency)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Variables $variables */
        $variables = $em->getRepository('AppBundle:Variables')->findLastRow()[0];
        $variables->setConverterCurrency($currency);

        $em->merge($variables);
        $em->flush();

        return new Response($currency, 200);
    }
}