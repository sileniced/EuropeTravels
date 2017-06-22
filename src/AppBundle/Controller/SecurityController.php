<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 22-6-2017
 * Time: 15:52
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\LoginForm;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {

        $em = $this->getDoctrine()->getManager();

        if (!$em->getRepository('AppBundle:User')->findLastRow()) {
            $newUser = new User('kitty');
            $em->persist($newUser);
            $em->flush();
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername,
        ]);

        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'form' => $form->createView(),
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('The silver lining of it all');
    }
}