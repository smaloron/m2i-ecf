<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchRoomType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('arrivalDate', DateType::class,
        [
          "label" => "Du",
          "widget" => "single_text"
        ])
      ->add('departureDate', DateType::class,
        [
          "label" => "Au",
          "widget" => "single_text"
        ])
      ->add('numberOfGuests', ChoiceType::class,
        [
          "label" => "Nombre de personnes",
          "choices" => [
            "1" => 1,
            "2" => 2
          ]
        ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      // Configure your form options here
    ]);
  }
}
