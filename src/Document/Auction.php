<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 */
class Auction
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $minPrice;

//    /**
//     * @MongoDB\Field(type="date")
//     */
//    protected $dateOfBet ;

    /**
     * @MongoDB\Field(type="mixed")
     */
    protected $bets;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;


    }

    /**
     * @param mixed $name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;

    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param mixed $minPrice
     */
    public function setMinPrice($minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;

    }

//    /**
//     * @return mixed
//     */
//    public function getDateOfBet()
//    {
//        return $this->dateOfBet;
//    }
//
//    /**
//     * @param mixed $dateOfBet
//     */
//    public function setDateOfBet($dateOfBet): self
//    {
//        $this->dateOfBet = $dateOfBet;
//
//        return $this;
//
//    }

    /**
     * @return mixed
     */
    public function getBets()
    {
        return $this->bets;
    }

    /**
     * @param mixed $bets
     */
    public function setBets($bets): self
    {
        $this->bets = $bets;

        return $this;
    }
}