<?php

namespace PortalBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('specialization', EntityType::class, array(
						'label' => 'Specjalizacja',
						'class'	=> 'PortalBundle:Specialization',
						'placeholder'  => ''))
				->add('date', null,['data'=>new \DateTime()])
				->add('patient', EntityType::class, array(
						'label' => 'Pacjent',
						'class'	=> 'PortalBundle:User',
						'placeholder'  => ''))
				->add('medical', EntityType::class, array(
						'label' 		=> 'Lekarz',
						'choice_label' 	=> function($medical) {
							return $medical->getTitle().' '.$medical->getName().' '.$medical->getSurname();},
						//'name',
						'class'			=> 'PortalBundle:Medical',
						'placeholder'  => ''))
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PortalBundle\Entity\Visit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'portalbundle_visit';
    }


}
