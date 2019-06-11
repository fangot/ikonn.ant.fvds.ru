<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\GreetingGenerator;
use App\Breadcrumbs;


class DefaultController extends AbstractController
{
	/**
	* @Route("/index", name="index")
	*/
	public function index(LoggerInterface $logger, GreetingGenerator $generator, Breadcrumbs $breadcrumbs)
	{
		$breadcrumbs->add('index', '/index');
		$breadcrumbs->add('task', '/task');
		$breadcrumbs->add('product', '/product');
		$breadcrumbs->add('simplicity', '/simplicity');

		return $this->render('default/index.html.twig', [
			'name' => "TEST",
			'bread' => $breadcrumbs->trail()
		]);
	}

	/**
	* @Route("/simplicity")
	*/
	public function simple(Breadcrumbs $breadcrumbs)
	{
		$breadcrumbs->add('index', '/index');
		$breadcrumbs->add('task', '/task');
		$breadcrumbs->add('product', '/product');
		$breadcrumbs->add('simplicity', '/simplicity');
		
		return $this->render('default/index.html.twig', [
			'name' => "Просто! Легко! Прекрасно!",
			'bread' => $breadcrumbs->trail()
		]);
	}
}
