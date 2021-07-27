<?php


namespace App\MessageHandler;


use App\Document\Product;
use App\Message\CheckProduct;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckProductHandler implements MessageHandlerInterface
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

    public function __invoke(CheckProduct $checkProduct)
    {
        $id = $checkProduct->getProductID();
        $product = $this->dm->getRepository(Product::class)->find($id);
        $date = new \DateTime();
        $product->setDateChecked($date);
        $this->dm->persist($product);
        $this->dm->flush();
    }
}