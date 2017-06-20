<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 20-6-2017
 * Time: 13:01
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="budget")
 */
class Budget
{
    private $id;

    private $endDate;

    private $ammount;

    private $ammountIDR;

    private $ammountToday;

    private $ammountTodayGBP;

    private $ammountTodayCZK;

    private $ammountTodayIDR;

    private $buzz;

    
}