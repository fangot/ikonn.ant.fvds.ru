<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
				// вы можете извлечь EntityManager через $this->getDoctrine()
				// или вы можете добавить аргумент в ваше действие: index(EntityManagerInterface $em)
				$em = $this->getDoctrine()->getManager();

				$product = new Product();
				$product->setName('Keyboard');
				$product->setPrice(19.99);
				$product->setDescription('Ergonomic and stylish!');
				$product->setPreview('test');

				// скажите Doctrine, что вы (в итоге) хотите сохранить Товар (пока без запросов)
				$em->persist($product);

				// на самом деле выполнить запросы (т.е. запрос INSERT)
				$em->flush();

				return new Response('Saved new product with id '.$product->getId());
    }

		/**
		 * @Route("/product/{id}", name="product_show")
		 */
		public function showAction($id)
		{
		    $product = $this->getDoctrine()
		        ->getRepository(Product::class)
		        ->find($id);

		    if (!$product) {
		        throw $this->createNotFoundException(
		            'No product found for id '.$id
		        );
		    }

		    return new Response('Check out this great product: '.$product->getName());

		    // или отобразить шаблон
		    // в шаблоне, отобразить всё с {{ product.name }}
		    // вернуть $this->render('product/show.html.twig', ['product' => $product]);
		}
}
