<?php


namespace App\DataFixtures;


use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements DependentFixtureInterface
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
      HotelFixtures::class
    ];
  }

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {

    $roomRef = 0;
    for ($h=1; $h <=3; $h++) {
      for ($r = 0; $r < 10; $r++) {
        $room = new Room();
        $room
          ->setHotel($this->getReference("hotel_{$h}"))
          ->setCapacity(mt_rand(1,2))
          ->setRate(mt_rand(40,90));
        $manager->persist($room);
        $this->addReference("room_". (++$roomRef), $room);
      }

      $manager->flush();

    }

  }
}