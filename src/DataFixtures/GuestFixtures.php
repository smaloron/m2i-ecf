<?php


namespace App\DataFixtures;


use App\Entity\Guest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class GuestFixtures extends Fixture
{

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {

    $faker = Faker\Factory::create("fr_FR");

    for ($g = 0; $g < 50; $g++) {
      $guest = new Guest();
      $guest
        ->setName($faker->name);
      $manager->persist($guest);
      $this->addReference("guest_" . ($g+1), $guest);
    }

    $manager->flush();

  }
}