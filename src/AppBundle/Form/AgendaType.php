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
            ->add('categoria', TextType::class, ['attr' => ['maxlength' => 30]])
            
            ->add(
                'atividade',
                TextareaType::class,
                
                [
                    'required' => false,
                    
                    'attr' => [
                        'maxlength' => 1000,
                        'cols' => 100,
                        'rows' => 25,
                    ],
                ]
            )
            
            ->add('data', DateType::class)
            ->add('hora', TimeType::class, ['required' => false])
            
            ->add(
                'periodico',
                ChoiceType::class,
                
                [
                    'choices' => [
                        '' => null,
                        'Sim' => 1,
                        'Não' => 0,
                    ],
                    
                    'choices_as_values' => true,
                ]
            )
            
            ->add('historia', HiddenType::class)
            ->add('cadastrar', SubmitType::class, ['label' => 'Cadastrar'])
        ;
    }
}
