<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-5-2017
 * Time: 22:12
 */

namespace AppBundle\Entity\Hotels;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="hotels")
 */
class Hotels
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $reservationNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arriveAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departAt;

    /**
     * @ORM\Column(type="float")
     */
    private $costs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isReservedWithCreditCard;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCharged;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hotels\HotelTransport", mappedBy="hotel")
     */
    private $transport;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hotels\HotelDocuments", mappedBy="hotel")
     */
    private $documents;

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
    public function getReservationNumber()
    {
        return $this->reservationNumber;
    }

    /**
     * @param mixed $reservationNumber
     */
    public function setReservationNumber($reservationNumber)
    {
        $this->reservationNumber = $reservationNumber;
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
    public function getArriveAt()
    {
        return $this->arriveAt;
    }

    /**
     * @param mixed $arriveAt
     */
    public function setArriveAt($arriveAt)
    {
        $this->arriveAt = $arriveAt;
    }

    /**
     * @return mixed
     */
    public function getDepartAt()
    {
        return $this->departAt;
    }

    /**
     * @param mixed $departAt
     */
    public function setDepartAt($departAt)
    {
        $this->departAt = $departAt;
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
    public function getisReservedWithCreditCard()
    {
        return $this->isReservedWithCreditCard;
    }

    /**
     * @param mixed $isReservedWithCreditCard
     */
    public function setIsReservedWithCreditCard($isReservedWithCreditCard)
    {
        $this->isReservedWithCreditCard = $isReservedWithCreditCard;
    }

    /**
     * @return mixed
     */
    public function getisCharged()
    {
        return $this->isCharged;
    }

    /**
     * @param mixed $isCharged
     */
    public function setIsCharged($isCharged)
    {
        $this->isCharged = $isCharged;
    }

    /**
     * @return mixed
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param mixed $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param mixed $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }


}