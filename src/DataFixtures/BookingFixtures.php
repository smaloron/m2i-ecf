<?php


namespace App\DataFixtures;


use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{

  /**
   * This method must return an array of fixtures classes
   * on which the implementing class depends on
   *
   * @return array
   */
  public function getDependencies()
  {
    return [
      RoomFixtures::class,
      GuestFixtures::class
    ];
  }

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {

    $faker = Faker\Factory::create("fr_FR");

    for ($b = 0; $b < 50; $b++) {
      $booking = new Booking();
      $arrivalDate = $faker->dateTimeThisMonth();
      $booking
        ->setArrivalDate($arrivalDate)
        ->setDepartureDate($faker->dateTimeBetween($arrivalDate))
        ->setGuest($this->getReference("guest_" . mt_rand(1, 50)));
      $room = $this->getReference("room_" . mt_rand(1, 30));
      $booking
        ->setNumberOfGuests($room->getCapacity())
        ->setRoom($room);
      $manager->persist($booking);
    }

    $manager->flush();

  }
}