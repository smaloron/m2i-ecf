<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('arrivalDate', DateType::class,
        [
          "label" => "Du",
          "widget" => "single_text",
          "attr" => [
            "class" => "form-control-plaintext"
          ],
          "data" => $options["from"]
        ])
      ->add('departureDate', DateType::class,
        [
          "label" => "Au",
          "widget" => "single_text",
          "attr" => [
            "class" => "form-control-plaintext"
          ],
          "data" => $options["to"]
        ])
      ->add('numberOfGuests', TextType::class,
        [
          "label" => "Nombre de personnes",
          "attr" => [
            "class" => "form-control-plaintext"
          ],
          "data" => $options["guests"]
        ])
      ->add('guest', GuestType::class,
        [
          "label" => "Client"
        ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Booking::class,
      'from' => null,
      'to' => null,
      'guests' => null
    ]);
  }
}
