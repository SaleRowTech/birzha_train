<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('productList');
    }
    /**
     * @Route("/product/create", name="productCreate")
     */
    public function createAction(DocumentManager $dm)
    {
        $product = new Product();
        $product->setName('A sdfsdf');
        $product->setPrice('199.999');
        $product->setDateChecked(new \DateTime('now'));

        $dm->persist($product);
        $dm->flush();

        //return new Response('Created product id ' . $product->getId());
        return $this->redirectToRoute('productList');
    }
    /**
     * @Route("/product/show/{id}", name="productShow")
     */
    public function showAction(DocumentManager $dm, $id)
    {
        $product = $dm->getRepository(Product::class)->find($id);

        if (! $product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        return $this->render('product/productShow.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/product/list", name="productList")
     */
    public function listAction(DocumentManager $dm)
    {
        $products = $dm->getRepository(Product::class)->findAll();

        if (! $products) {
            throw $this->createNotFoundException('No product found in DB');
        }

        return $this->render('product/productList.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/delete/{id}", name="productDelete")
     */
    public function deleteAction(DocumentManager $dm, $id)
    {
        $product = $dm->getRepository(Product::class)->find($id);

        $dm->remove($product);
        $dm->flush();

        return $this->redirectToRoute('productList');
    }

    /**
     * @Route("/product/check/{id}", name="productCheck")
     */
    public function checkAction(DocumentManager $dm, $id)
    {
        $product = $dm->getRepository(Product::class)->find($id);
        $date = new \DateTime('now');
        $product->setDateChecked($date);

        return $this->redirectToRoute('productList');
    }


}
