<?php

namespace App\Entity;

use App\Helper\Country;
use App\Strategy\Tax\TaxForeign;
use App\Strategy\Tax\TaxInterface;
use App\Strategy\Tax\TaxPL;


/**
 * Class Order
 * @package App\Entity
 */
class Order extends Timestampable
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var TaxInterface
     */
    private $tax;

    /**
     * @todo implement unique number
     *
     * @var string
     */
    private $number;


    /**
     * Order constructor.
     *
     * @param Product $product
     * @param int $quantity
     * @param string $country
     *
     * @throws \Exception
     */
    public function __construct(Product $product, int $quantity, string $country)
    {
        parent::__construct();

        $this->product  = $product;
        $this->quantity = $quantity;

        if ($quantity > $product->getQuantity()) {
            throw new \InvalidArgumentException('Product is not available with provided quantity');
        }

        $product->orderQuantity($quantity);

        if ($country === Country::PL) {
            $this->tax = new TaxPL();
        } else {
            $this->tax = new TaxForeign();
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getTotalGross(): float
    {
        return $this->getTotalNet() + $this->getTax();
    }

    /**
     * @return float
     */
    public function getTotalNet(): float
    {
        return $this->quantity * $this->product->getPrice();
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax->count( $this->getTotalNet() );
    }

}