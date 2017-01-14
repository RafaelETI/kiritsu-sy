<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'categoria',
                TextType::class,
                
                [
                    'attr' => [
                        'minlength' => 2,
                        'maxlength' => 30,
                        'autofocus' => null
                    ]
                ]
            )
            
            ->add(
                'atividade',
                TextareaType::class,
                
                [
                    'required' => false,
                    
                    'attr' => [
                        'minlength' => 2,
                        'maxlength' => 1000,
                        'cols' => 100,
                        'rows' => 25,
                    ],
                ]
            )
            
            ->add('data', DateType::class, ['data' => new \DateTime])
            ->add('hora', TimeType::class, ['required' => false])
            
            ->add(
                'periodico',
                ChoiceType::class,
                
                [
                    'choices' => [
                        'Não' => 0,
                        'Sim' => 1,
                    ],
                    
                    'choices_as_values' => true,
                ]
            )
            
            ->add('historia', HiddenType::class, ['data' => 0])
            ->add('cadastrar', SubmitType::class, ['label' => 'Cadastrar'])
        ;
    }
}
