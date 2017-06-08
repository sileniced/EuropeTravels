<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 29-5-2017
 * Time: 14:15
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentStatusRepository")
 * @ORM\Table(name="payment_status")
 */
class PaymentStatus
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

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
    private $entity;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Payment", mappedBy="paymentStatus")
     */
    private $payment;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Transport", mappedBy="paymentStatus")
     */
    private $transport;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Hotel", mappedBy="paymentStatus")
     */
    private $hotel;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Attraction", mappedBy="paymentStatus")
     */
    private $attraction;

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
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
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
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param mixed $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * @return mixed
     */
    public function getAttraction()
    {
        return $this->attraction;
    }

    /**
     * @param mixed $attraction
     */
    public function setAttraction($attraction)
    {
        $this->attraction = $attraction;
    }

}