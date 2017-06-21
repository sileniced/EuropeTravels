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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BudgetRepository")
 * @ORM\Table(name="budget")
 */
class Budget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastDay;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     */
    private $amountToday;

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
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getLastDay()
    {
        return $this->lastDay;
    }

    /**
     * @param mixed $lastDay
     */
    public function setLastDay($lastDay)
    {
        $this->lastDay = $lastDay;
    }

    /**
     * @return mixed
     */
    public function getAmountToday()
    {
        return $this->amountToday;
    }

    /**
     * @param mixed $amountToday
     */
    public function setAmountToday($amountToday)
    {
        $this->amountToday = $amountToday;
    }


}