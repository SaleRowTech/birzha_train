<?php


namespace App\MessageHandler;


use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckProductHandler implements MessageHandlerInterface
{
    public function __invoke(AddPonkaToImage $addPonkaToImage)
    {
        dump(123);
    }
}