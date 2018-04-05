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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttractionRepository")
 * @ORM\Table(name="attraction")
 */
class Attraction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Destination", inversedBy="attraction")
     */
    private $destination;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Itinerary", inversedBy="attraction", cascade={"persist"})
     */
    private $itinerary;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PaymentStatus", inversedBy="attraction", cascade={"persist"})
     */
    private $paymentStatus;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Document",
     *     mappedBy="attraction",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    private $documents;

    /**
     * Attraction constructor.
     */
    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return Itinerary
     */
    public function getItinerary(): Itinerary
    {
        return $this->itinerary;
    }

    /**
     * @param Itinerary $itinerary
     */
    public function setItinerary(Itinerary $itinerary): void
    {
        $itinerary->setEntity('Attraction');
        $this->itinerary = $itinerary;
    }

    /**
     * @return PaymentStatus
     */
    public function getPaymentStatus(): PaymentStatus
    {
        return $this->paymentStatus;
    }

    /**
     * @param PaymentStatus $paymentStatus
     */
    public function setPaymentStatus(PaymentStatus $paymentStatus): void
    {
        $paymentStatus->setEntity('Attraction');
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return Destination
     */
    public function getDestination(): Destination
    {
        return $this->destination;
    }

    /**
     * @param Destination $destination
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return ArrayCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param Document $document
     */
    public function addDocument(Document $document): void
    {
        if($this->documents->contains($document)) {
            return;
        }

        $this->documents[] = $document;

        $document->setEntity('Attraction');
        $document->setAttraction($this);
    }

    /**
     * @param Document $document
     */
    public function removeDocument(Document $document): void
    {
        if (!$this->documents->contains($document)) return;

        if (unlink($document->getDocumentPath())) {
            $this->documents->removeElement($document);
            $document->setAttraction(null);
        }
    }

}