<?php

namespace App\Entity;

/**
 * Class Product
 * @package App\Entity
 */
class Product implements Timestampable
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $vat;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;


    /**
     * Product constructor.
     *
     * @param string $name
     * @param float $price
     * @param float $vat
     * @param int $quantity
     *
     * @throws \Exception
     */
    public function __construct(string $name, float $price, float $vat, int $quantity)
    {
        $this->name      = $name;
        $this->price     = $price;
        $this->vat       = $vat;
        $this->quantity  = $quantity;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param int $orderedQuantity
     * @throws \Exception
     */
    public function reduceQuantity(int $orderedQuantity)
    {
        $this->quantity  = $this->quantity - $orderedQuantity;
        $this->updatedAt = new \DateTime();
    }

}