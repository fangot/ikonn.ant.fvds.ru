<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\Task;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
						//->setAction($this->generateUrl('target_route'))
            //->setMethod('GET')
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text'))
						->add('agreeTerms', CheckboxType::class, array('mapped' => false))
            ->add('save', SubmitType::class)
        ;
    }

		public function configureOptions(OptionsResolver $resolver)
		{
		    $resolver->setDefaults(array(
		        'data_class' => Task::class,
		    ));
		}
}
