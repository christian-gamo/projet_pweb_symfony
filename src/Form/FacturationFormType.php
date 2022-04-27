<?php

namespace App\Form;

use DateTime;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class FacturationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idV', EntityType::class, [
                'class' => Vehicule::class,
                'query_builder' => function (VehiculeRepository $ve) {
                    return $ve->createQueryBuilder('v')
                        ->where("v.location LIKE 'Disponible'");
                },
                'choice_label' => 'type',
                'required' => true,
                'label' => 'Voiture',
            ])
            ->add('dateD', DateTimeType::class,[
                'label' => 'Date de début',
                'widget' => 'single_text', 
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' =>'MM/dd/yyyy',
                'required' => true,
            ])
            ->add('dateF', DateTimeType::class,[
                'required' => true,
                'label' => 'Date de fin',
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' =>'MM/dd/yyyy',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn_connexion'],
            ])
        ;
    }
}