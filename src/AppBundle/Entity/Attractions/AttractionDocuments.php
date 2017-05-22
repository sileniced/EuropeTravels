<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:14
 */

namespace AppBundle\Entity\Attractions;


use AppBundle\Entity\Documents;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attraction_documents")
 */
class AttractionDocuments extends Documents
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