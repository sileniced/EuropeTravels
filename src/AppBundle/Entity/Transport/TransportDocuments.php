<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 23-5-2017
 * Time: 00:46
 */

namespace AppBundle\Entity\Transport;


use AppBundle\Entity\Documents;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="transport_documents")
 */
class TransportDocuments extends Documents
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transport\Transport", inversedBy="documents")
     */
    private $transport;
}