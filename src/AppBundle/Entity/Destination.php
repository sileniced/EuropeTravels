<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 05/04/2018
 * Time: 20:11
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="destination")
 */
class Destination
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hotel", mappedBy="destination")
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Attraction", mappedBy="destination")
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
    public function setHotel($hotel): void
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
    public function setAttraction($attraction): void
    {
        $this->attraction = $attraction;
    }


}