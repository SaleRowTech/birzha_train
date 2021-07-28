<?php


namespace App\MessageHandler;

use App\Document\Auction;
use App\Message\AddBet;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Ramsey\Uuid\Uuid;


class AddBetHandler implements MessageHandlerInterface
{
    /**
     * @var DocumentManager
     */
    private $dm;
    /**
     * CheckProductHandler constructor.
     */
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
    public function __invoke(AddBet $addBet)
    {
        $data = $addBet->getData();
        $user = $addBet->getUser();
        $id = $addBet->getId();
        $auction = $this->dm->getRepository(Auction::class)->findOneBy(['id' => $id]);
        $date = new \DateTime('@'.strtotime('now'));
        $unique = Uuid::uuid4();
        $array = [
            (string)$unique =>[
                "bet" => $data['bet'],
                "date"=> $date,
                "user" => $user->getId(),
            ]
        ];
        if ($bets = json_decode($auction->getBets()) === null){
            $collection = $array;
        }

        if ($bets === null){
            $collection = $array;
        }else{
            $collectionBefore = [
                array_merge($array, (array)$bets)
            ];
            $collection=$collectionBefore[0];
        }
        $auction->setBets(json_encode($collection));
        $this->dm->persist($auction);
        $this->dm->flush();

    }
}









