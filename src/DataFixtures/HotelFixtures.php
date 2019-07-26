<?php


namespace App\DataFixtures;


use App\Entity\Hotel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class HotelFixtures extends Fixture
{

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {

    $hotels = [
      "Novobis Paris 11",
      "Mertel Paris 11",
      "Icure Paris 11"
    ];
    $faker = Faker\Factory::create("fr_FR");

    for ($h=0; $h<=2; $h++) {
      $hotel = new Hotel();
      $hotel
        ->setName($hotels[$h])
        ->setAddress($faker->address);
      $manager->persist($hotel);
      $this->addReference("hotel_". ($h+1), $hotel);
    }

    $manager->flush();

  }
}