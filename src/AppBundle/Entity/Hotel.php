<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-5-2017
 * Time: 22:12
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HotelRepository")
 * @ORM\Table(name="hotel")
 */
class Hotel
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
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Itinerary", inversedBy="hotel", cascade={"persist"})
     */
    private $itinerary;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PaymentStatus", inversedBy="hotel", cascade={"persist"})
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

        $document->setEntity('Hotel');
        $document->setHotel($this);
    }

    public function removeDocument(Document $document)
    {
        if (!$this->documents->contains($document)) {
            return null;
        }

        if (unlink($document->getDocumentPath())) {
            $this->documents->removeElement($document);
            $document->setHotel(null);
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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
    public function getItinerary()
    {
        return $this->itinerary;
    }

    /**
     * @param mixed $itinerary
     */
    public function setItinerary(Itinerary $itinerary)
    {
        $itinerary->setEntity('Hotel');
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
        $paymentStatus->setEntity('Hotel');
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

}