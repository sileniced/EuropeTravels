<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:40
 */

namespace AppBundle\Entity\Prepayments;


use AppBundle\Entity\Documents;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prepayments_documents")
 */
class PrepaymentsDocuments extends Documents
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Prepayments\Prepayments", inversedBy="documents")
     */
    private $prepayment;

    /**
     * @return mixed
     */
    public function getPrepayment()
    {
        return $this->prepayment;
    }

    /**
     * @param mixed $prepayment
     */
    public function setPrepayment($prepayment)
    {
        $this->prepayment = $prepayment;
    }


}