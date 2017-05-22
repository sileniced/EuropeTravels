<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:05
 */

namespace AppBundle\Entity\Hotels;


use AppBundle\Entity\Transport\Transport;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="hotel_transport")
 */
class HotelTransport extends Transport
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Hotels", inversedBy="transport")
     * @ORM\Column(type="string")
     */
    private $hotel;

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


}