<?php


namespace App\Message;


use App\Document\Product;

class CheckProduct
{
    /**
     * @var string
     */
    private $productID;

    /**
     * CheckProduct constructor.
     */
    public function __construct(string $productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return string
     */
    public function getProductID(): string
    {
        return $this->productID;
    }

}