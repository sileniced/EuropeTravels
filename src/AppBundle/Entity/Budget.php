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
use function Symfony\Component\Debug\Tests\testHeader;

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
     * @ORM\Column(type="float")
     */
    private $amount;

    private $spent;

    /**
     * @ORM\Column(type="float")
     */
    private $amountToday;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BudgetSubtraction", mappedBy="budget")
     */
    private $budgetSubtraction = [];

    /**
     * Budget constructor.
     * @param array $budgetSubtraction
     */
    public function __construct(array $budgetSubtraction)
    {
        $this->budgetSubtraction = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSpent()
    {
        $spent = 0;

        foreach ($this->getBudgetSubtraction() as $subtraction) {
            $spent += $subtraction->getAmount();
        }

        return $spent;
    }

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

    /**
     * @return mixed
     */
    public function getBudgetSubtraction()
    {
        return $this->budgetSubtraction;
    }

    /**
     * @param mixed $budgetSubtraction
     */
    public function setBudgetSubtraction(BudgetSubtraction $budgetSubtraction)
    {
        $this->budgetSubtraction = $budgetSubtraction;
    }

}