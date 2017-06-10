<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-5-2017
 * Time: 22:13
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prepayments")
 */
class Payment
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PaymentStatus", inversedBy="payment", cascade={"persist"})
     */
    private $paymentStatus;

    /**
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Document",
     *     mappedBy="attraction",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    private $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    public function addDocument(Document $document)
    {
        if($this->documents->contains($document)) {
            return null;
        }

        $this->documents[] = $document;

        $document->setEntity('Payment');
        $document->setPayment($this);
    }

    public function removeDocument(Document $document)
    {
        if (!$this->documents->contains($document)) {
            return null;
        }

        if (unlink($document->getDocumentPath())) {
            $this->documents->removeElement($document);
            $document->setPayment(null);
        }
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

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
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus(PaymentStatus $paymentStatus)
    {
        $paymentStatus->setEntity('Payment');
        $this->paymentStatus = $paymentStatus;
    }


}