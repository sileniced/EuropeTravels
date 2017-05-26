<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 25-1-2017
 * Time: 19:08
 */

namespace AppBundle\Service;


use AppBundle\Entity\Hash;
use Doctrine\ORM\EntityManager;

class hashGenerator
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * UniqueHashGenerator constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function generate()
    {
        $count = 10;

        do {

            $count++;

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $hash = '';

            for ($i = 0; $i < $count; $i++) {
                $hash .= $characters[rand(0, $charactersLength - 1)];
            }

        } while ($this->em->getRepository('AppBundle:Hash')
            ->findOneBy(['hash' => $hash]));

        return $hash;
    }
}