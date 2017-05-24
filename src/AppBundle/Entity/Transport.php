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
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @ORM\Column(type="string")
     */
    private $reservationNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $transportReference;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $transporter;

    /**
     * @ORM\Column(type="string")
     */
    private $meansOfTransport;

    /**
     * @ORM\Column(type="string")
     */
    private $depart;

    /**
     * @ORM\Column(type="string")
     */
    private $arrival;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startsAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endsAt;

    /**
     * @ORM\Column(type="float")
     */
    private $costs;

    /**
     * @ORM\Column(type="string")
     */
    private $paymentStatus;

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
    public function getTransportReference()
    {
        return $this->transportReference;
    }

    /**
     * @param mixed $transportReference
     */
    public function setTransportReference($transportReference)
    {
        $this->transportReference = $transportReference;
    }

    /**
     * @return mixed
     */
    public function getTransporter()
    {
        return $this->transporter;
    }

    /**
     * @param mixed $transporter
     */
    public function setTransporter($transporter)
    {
        $this->transporter = $transporter;
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
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param mixed $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * @return mixed
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * @param mixed $startsAt
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;
    }

    /**
     * @return mixed
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * @param mixed $endsAt
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;
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

}