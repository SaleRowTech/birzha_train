<?php


namespace App\Message;


use App\Document\Product;

class CheckProduct
{
    /**
     * @var int
     */
    private $productID;

    /**
     * CheckProduct constructor.
     */
    public function __construct(int $productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return int
     */
    public function getProductID(): int
    {
        return $this->productID;
    }

}