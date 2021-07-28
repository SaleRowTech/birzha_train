<?php


namespace App\Message;


class AddBet
{
    private $data;
    private $user;
    private $id;

    /**
     * AddBet constructor.
     */
    public function __construct($data, $user, $id)
    {
        $this->data = $data;
        $this->user = $user;
        $this->id = $id;
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
    public function getId()
    {
        return $this->id;
    }

}