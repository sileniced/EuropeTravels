<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 16:19
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VariablesRepository")
 * @ORM\Table(name="variables")
 */
class Variables
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $converterCurrency;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getConverterCurrency()
    {
        return $this->converterCurrency;
    }

    /**
     * @param mixed $converterCurrency
     */
    public function setConverterCurrency($converterCurrency)
    {
        $this->converterCurrency = $converterCurrency;
    }


}