<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 22-5-2017
 * Time: 22:13
 */

namespace AppBundle\Entity\Transport;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
    private $departAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arriveAt;

    /**
     * @ORM\Column(type="float")
     */
    private $costs;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transport\TransportDocuments", mappedBy="transport")
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