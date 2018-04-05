<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 20-6-2017
 * Time: 13:01
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
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
    private $endDateAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $amountToday;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BudgetSubtraction", mappedBy="budget")
     */
    private $budgetSubtraction = [];

    /**
     * Budget constructor.
     */
    public function __construct( /** array $budgetSubtraction */ )
    {
        $this->budgetSubtraction = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getSpent(): int
    {
        $spent = 0;

        /** @var BudgetSubtraction $subtraction */
        foreach ($this->getBudgetSubtraction() as $subtraction) {
            $spent += $subtraction->getAmount();
        }

        return $spent;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getEndDateAt()
    {
        return $this->endDateAt;
    }

    /**
     * @param $endDateAt
     */
    public function setEndDateAt($endDateAt)
    {
        $this->endDateAt = $endDateAt;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmountToday(): int
    {
        return $this->amountToday;
    }

    /**
     * @param int $amountToday
     */
    public function setAmountToday(int $amountToday)
    {
        $this->amountToday = $amountToday;
    }

    /**
     * @return ArrayCollection
     */
    public function getBudgetSubtraction()
    {
        return $this->budgetSubtraction;
    }

    /**
     * @param BudgetSubtraction $budgetSubtraction
     */
    public function setBudgetSubtraction(BudgetSubtraction $budgetSubtraction)
    {
        $this->budgetSubtraction = $budgetSubtraction;
    }

}