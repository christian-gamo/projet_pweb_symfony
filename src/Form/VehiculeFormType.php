<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VehiculeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add(
                $builder->create('caract', FormType::class)
                ->add('Moteur', ChoiceType::class, [
                    'choices' => [
                         'Diesel '=> 'Diesel',
                         'Essence'=> 'Essence',
                         'Hybride'=>'Hybride',
                         'Électrique'=>'Électrique',
                         'GPL'=>'GPL',
                         'E85'=>'E85',
                    ],
                    'placeholder'=>'Sélectionner un moteur',
                ])
                ->add('Vitesse', ChoiceType::class, [
                    'choices' => [
                        'Manuelle' => 'Manuelle',
                        'Automatique'=>'Automatique',
                        'Séquentielle'=>'Séquentielle'
                    ],
                    'placeholder'=>'Sélectionner une vitesse',
                ])
                ->add('NombreDePlaces', ChoiceType::class, [
                    'choices' =>[
                          '1'=>1,
                          '2'=>2,
                          '3'=>3,
                          '4'=>4,
                          '5'=>5,
                    ],
                    'placeholder'=>'Sélectionner le nombre de places',
                ])
            )
            ->add('location', ChoiceType::class, [
                'choices' => [
                    'Disponible' => 'Disponible',
                    'En révision' => 'En_revision',
                ],
            ])
            ->add('imageFile', FileType::class,[
                'mapped'=>false,
                'required'=>true,
                'constraints' => [
                    new Image()
                ],
            ])
            ->add('prixJour', IntegerType::class,[
                'label' => 'Prix/jour',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
