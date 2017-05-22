<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:07
 */

namespace AppBundle\Entity\Hotels;


use AppBundle\Entity\Documents;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="hotel_documents")
 */
class HotelDocuments extends Documents
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Hotels\Hotels", inversedBy="documents")
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