<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Room;
use App\Repository\HotelRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class RoomFixtures extends Fixture
{
    /**
     * @var HotelRepository
     */
    private  $repository;

    /**
     * RoomFixtures constructor.
     * @param HotelRepository $repository
     */
    public function __construct(HotelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $hotels=$this->repository->findAll();
        foreach ($hotels as $hotel){

                for ($i = 1; $i <= 10; $i++) {
                    $room = new Room();
                    $room->setRoomNumber($i)->setHotel($hotel)->setImage($faker->imageUrl($width = 640, $height = 480))
                        ->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 100))
                        ->setRoomCapacityPerson(2);

                    $manager->persist($room);
                }
        }
        $manager->flush();
    }
}
