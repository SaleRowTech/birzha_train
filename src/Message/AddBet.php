<?php


namespace App\Message;


class AddBet
{
    private $data;
    private $user;
    private $auction;

    /**
     * AddBet constructor.
     */
    public function __construct($data, $user, $auction)
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getAuction()
    {
        return $this->auction;
    }

}