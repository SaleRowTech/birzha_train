<?php

namespace App\Controller;
use App\Document\Auction;

use Doctrine\ODM\MongoDB\DocumentManager;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    /**
     * @Route("/auction", name="auction")
     */
    public function index(): Response
    {
        return $this->render('auction/index.html.twig', [
            'controller_name' => 'AuctionController',
        ]);
    }
    /**
     * @Route("/product/create", name="productCreate")
     */
    public function createAction(DocumentManager $dm)
    {
        $product = new Auction();
        $product->setName('A sdfsdf');
        $product->setPrice('199.999');
        $product->setDateChecked(new \DateTime());


        $dm->persist($product);
        $dm->flush();

        //return new Response('Created product id ' . $product->getId());
        return $this->redirectToRoute('productList');
    }
    /**
     * @Route("/auction/create", name="create")
     */
    public function create(Request $request, DocumentManager $dm): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', IntegerType::class)
            ->add('minPrice', PasswordType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //here will be method, that saving data from form in base(array)
            $data = $form->getData();
            $auction = new Auction();
            $auction->setName($data['name']);
            $auction->setMinPrice($data['minPrice']);

            $dm->persist($auction);
            $dm->flush();

        }

        return $this->render('/auction/form_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
