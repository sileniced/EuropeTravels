<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-5-2017
 * Time: 22:13
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prepayments")
 */
class Prepayments
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
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $costs;

    /**
     * @ORM\Column(type="string")
     */
    private $paymentStatus;

    /**
     * @ORM\Column(type="string")
     */
    private $documentDescription1;

    private $document1;

    /**
     * @ORM\Column(type="string")
     */
    private $documentPath1;

    /**
     * @ORM\Column(type="string")
     */
    private $documentDescription2;

    private $document2;

    /**
     * @ORM\Column(type="string")
     */
    private $documentPath2;

    /**
     * @ORM\Column(type="string")
     */
    private $documentDescription3;

    private $document3;

    /**
     * @ORM\Column(type="string")
     */
    private $documentPath3;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param mixed $costs
     */
    public function setCosts($costs)
    {
        $this->costs = $costs;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return mixed
     */
    public function getDocumentDescription1()
    {
        return $this->documentDescription1;
    }

    /**
     * @param mixed $documentDescription1
     */
    public function setDocumentDescription1($documentDescription1)
    {
        $this->documentDescription1 = $documentDescription1;
    }

    /**
     * @return mixed
     */
    public function getDocument1()
    {
        return $this->document1;
    }

    /**
     * @param mixed $document1
     */
    public function setDocument1($document1)
    {
        $this->document1 = $document1;
    }

    /**
     * @return mixed
     */
    public function getDocumentPath1()
    {
        return $this->documentPath1;
    }

    /**
     * @param mixed $documentPath1
     */
    public function setDocumentPath1($documentPath1)
    {
        $this->documentPath1 = $documentPath1;
    }

    /**
     * @return mixed
     */
    public function getDocumentDescription2()
    {
        return $this->documentDescription2;
    }

    /**
     * @param mixed $documentDescription2
     */
    public function setDocumentDescription2($documentDescription2)
    {
        $this->documentDescription2 = $documentDescription2;
    }

    /**
     * @return mixed
     */
    public function getDocument2()
    {
        return $this->document2;
    }

    /**
     * @param mixed $document2
     */
    public function setDocument2($document2)
    {
        $this->document2 = $document2;
    }

    /**
     * @return mixed
     */
    public function getDocumentPath2()
    {
        return $this->documentPath2;
    }

    /**
     * @param mixed $documentPath2
     */
    public function setDocumentPath2($documentPath2)
    {
        $this->documentPath2 = $documentPath2;
    }

    /**
     * @return mixed
     */
    public function getDocumentDescription3()
    {
        return $this->documentDescription3;
    }

    /**
     * @param mixed $documentDescription3
     */
    public function setDocumentDescription3($documentDescription3)
    {
        $this->documentDescription3 = $documentDescription3;
    }

    /**
     * @return mixed
     */
    public function getDocument3()
    {
        return $this->document3;
    }

    /**
     * @param mixed $document3
     */
    public function setDocument3($document3)
    {
        $this->document3 = $document3;
    }

    /**
     * @return mixed
     */
    public function getDocumentPath3()
    {
        return $this->documentPath3;
    }

    /**
     * @param mixed $documentPath3
     */
    public function setDocumentPath3($documentPath3)
    {
        $this->documentPath3 = $documentPath3;
    }

}