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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransportRepository")
 * @ORM\Table(name="transport")
 */
class Transport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $meansOfTransport;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Itinerary", inversedBy="transport", cascade={"persist"})
     */
    private $itinerary;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PaymentStatus", inversedBy="transport", cascade={"persist"})
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

        $document->setEntity('Transport');
        $document->setTransport($this);
    }

    public function removeDocument(Document $document)
    {
        if (!$this->documents->contains($document)) {
            return null;
        }

        if (unlink($document->getDocumentPath())) {
            $this->documents->removeElement($document);
            $document->setTransport(null);
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
    public function getMeansOfTransport()
    {
        return $this->meansOfTransport;
    }

    /**
     * @param mixed $meansOfTransport
     */
    public function setMeansOfTransport($meansOfTransport)
    {
        $this->meansOfTransport = $meansOfTransport;
    }

    /**
     * @return mixed
     */
    public function getItinerary()
    {
        return $this->itinerary;
    }

    /**
     * @param mixed $itinerary
     */
    public function setItinerary(Itinerary $itinerary)
    {
        $itinerary->setEntity('Transport');
        $this->itinerary = $itinerary;
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
        $paymentStatus->setEntity('Transport');
        $this->paymentStatus = $paymentStatus;
    }

}