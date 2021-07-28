<?php

namespace App\Controller;
use App\Document\Auction;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\GreaterThan;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class AuctionController extends AbstractController
{
    /**
     * @Route("/auction", name="auction")
     */
    public function index(DocumentManager $dm): Response
    {
        $auctions = $dm->getRepository(Auction::class)->findAll();
        if (! $auctions) {
            throw $this->createNotFoundException('No auctions found in DB');
        }
        return $this->render('auction/index.html.twig', [
            'auctions' => $auctions,

        ]);
    }

    /**
     * @Route("/auction/create", name="create")
     */
    public function create(Request $request, DocumentManager $dm): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('minPrice', IntegerType::class)
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

    /**
     * @Route("/auction/{id}/bet", name="auctionBet")
     */
    public function bet(Request $request, DocumentManager $dm, string $id): Response
    {
        $user = $this->getUser();
        $auction = $dm->getRepository(Auction::class)->findOneBy(['id' => $id]);
        //dd($auction);
       // dd($auction->getMinPrice());
        $form = $this->createFormBuilder()
            ->add('bet', IntegerType::class, array(
                'constraints' => new GreaterThan($auction->getMinPrice()),
                'label' => 'Ваша ставка'
            ))

            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //here will be method, that saving data from form in base(array)
            $data = $form->getData();
            $date = new \DateTime('@'.strtotime('now'));
            $unique = Uuid::uuid4();
            $array = [
                (string)$unique =>[
                    "bet" => $data['bet'],
                    "date"=> $date,
                    "user" => $user->getId(),
                ]
            ];
            //dd(json_encode($array));
            $bets = json_decode($auction->getBets());
            //dd($bets);
            if ($bets === null){
                $collection = $array;
            }else{
                //dd($bets);
                $collection = [
                    array_merge($array, (array)$bets)
                ];
                dd($collection);
            }


            //dd($collection);
            $auction->setBets(json_encode($collection));


            $dm->persist($auction);
            $dm->flush();
        }

        //$form->handleRequest($request);
        return $this->render('/auction/bet/form_create.html.twig', [
            'form' => $form->createView(),
            'auction' => $auction,
        ]);
    }


    /**
     * @Route("/auction/{id}/betList", name="betList")
     */
    public function betList(DocumentManager $dm, string $id): Response
    {
        $auction = $dm->getRepository(Auction::class)->findOneBy(['id' => $id]);
        if (! $auction) {
            throw $this->createNotFoundException('No such auction found in DB');
        }
        $bets = json_decode($auction->getBets());

        $data = $bets;
        return $this->render('auction/bet/bets.html.twig', [
            'bets' => $data,
        ]);
    }

    /**
     * @Route("/auction/delete/{id}", name="AuctionDelete")
     */
    public function deleteAction(DocumentManager $dm, $id)
    {
        $auction = $dm->getRepository(Auction::class)->find($id);

        $dm->remove($auction);
        $dm->flush();

        return $this->redirectToRoute('auction');
    }
}
