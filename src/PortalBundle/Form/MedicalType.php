<?php

namespace PortalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MedicalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', EntityType::class, array(
        				'label' 		=> 'Tytuł',
						'class' 		=> 'PortalBundle:Title',
						'query_builder' => function (EntityRepository $er) {
							return $er->createQueryBuilder('u')
								->orderBy('u.title', 'ASC');},
						'placeholder'  => ''))
				->add('name', TextType::class, array('label' => 'Imię'))
				->add('surname', TextType::class, array('label' => 'Nazwisko'))
				->add('pwz', NumberType::class, array('label' => 'PWZ'))
				->add('email', EmailType::class, array('label' => 'Adres email'))
				->add('username', TextType::class, array('label' => 'Username'))
				->add('specialization', EntityType::class, array(
						// query choices from this entity
						'class' 		=> 'PortalBundle:Specialization',
						'choice_label' 	=> 'type',
						'label' 		=> 'Specjalizacja',
						'query_builder' => function (EntityRepository $er) {
							return $er->createQueryBuilder('u')
								->orderBy('u.type', 'ASC');
						},
						'placeholder'  => ''))
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PortalBundle\Entity\Medical'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'portalbundle_medical';
    }


}
