<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\CarCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbSeats', IntegerType::class, [

                "label" => "Nombre de siège : "


            ])
            ->add('nbDoors', IntegerType::class, [

                "label" => "Nombre de porte : "


            ])
            ->add('name', TextType::class, [

                "label" => "Nom : "


            ])
            ->add('cost', IntegerType::class, [

                "label" => "Prix : "


            ])
            ->add('category', EntityType::class, [

                'required' => false,
                'class' => CarCategory::class,
                "label" => "catégorie : "


            ])
            ->add('submit', SubmitType::class, [
                'label' => "Sauvegarder",
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
