<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 16:26
 */

namespace AppBundle\Service;


use AppBundle\Entity\Variables;
use Doctrine\ORM\EntityManager;

class getVariables
{
    private $em;

    /**
     * getVariables constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getVariables()
    {
        $variables = $this->em->getRepository('AppBundle:Variables')->findLastRow();

        if (null == $variables) {
            $variables = new Variables();
            $variables->setConverterCurrency('EUR');

            $this->em->persist($variables);
            $this->em->flush();
        } else {
            $variables = $variables[0];
        }

        return $variables;
    }
}