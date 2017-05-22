<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:25
 */

namespace AppBundle\Entity\Attractions;


use AppBundle\Entity\Transport\Transport;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attraction_transport")
 */
class AttractionTransport extends Transport
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Attractions\Attractions", inversedBy="documents")
     */
    private $attraction;

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