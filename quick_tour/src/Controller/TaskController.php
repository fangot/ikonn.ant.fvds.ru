<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TaskType;

class TaskController extends AbstractController
{
    /**
     * @Route("/task")
     */
		 public function index(Request $request)
		 {
		     // just setup a fresh $task object (remove the dummy data)
		     $task = new Task();

				 $form = $this->createForm(TaskType::class, $task);

		     /*$form = $this->createFormBuilder($task)
		         ->add('task', NumberType::class)
		         ->add('dueDate', DateType::class)
		         ->add('save', SubmitType::class, ['label' => 'Create Task'])
		         ->getForm();
					*/
		     $form->handleRequest($request);

		     if ($form->isSubmitted() && $form->isValid() && $form->get('agreeTerms')->getData()) {
		         // $form->getData() holds the submitted values
		         // but, the original `$task` variable has also been updated

		         $entityManager = $this->getDoctrine()->getManager();
		         $entityManager->persist($task);
		         $entityManager->flush();

						 $this->addFlash(
		            'notice',
		            'Your changes were saved!'
		        );

						 return new Response('Saved new task '.$task->getTask());

		        //return $this->redirectToRoute('test');
		     }
				 //throw $this->createNotFoundException('The product does not exist');

		     return $this->render('task/index.html.twig', [
		         'form' => $form->createView(),
						 'h1' => 'Тестовая страница',
						 'title' => 'Тестовая страница'
		     ]);
		 }
		 /**
			* @Route("/test", name="test")
			*/
		 public function test() {
			 return $this->render('default/index.html.twig', [
			 ]);
		 }
}
