<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Hotel;

class HotelFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0 ;$i<3;$i++){
            $hotel = new Hotel();
            $hotel->setName($faker->company)->setDescription($faker->word(3))->setImage($faker->imageUrl($width = 640, $height = 480))->setAdresse($faker->streetAddress)->setZipCode($faker->postcode);
            $manager->persist($hotel);



        }

        $manager->flush();
    }
}
