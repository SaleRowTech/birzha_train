<?php


namespace App\MessageHandler;


use App\Message\CheckProduct;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckProductHandler implements MessageHandlerInterface
{
    public function __invoke(CheckProduct $checkProduct)
    {
        dump(123);
    }
}