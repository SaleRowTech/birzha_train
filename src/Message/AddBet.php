<?php


namespace App\Message;


use App\Document\Auction;
use App\Entity\User;

class AddBet
{
    private $data;
    private $user;
    private $auction;

    /**
     * AddBet constructor.
     */
    public function __construct($data,User $user, Auction $auction)
    {
        $this->data = $data;
        $this->user = $user;
        $this->auction = $auction;
    }
    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function getUser():User
    {
        return $this->user;
    }


    public function getAuction(): Auction
    {
        return $this->auction;
    }

}