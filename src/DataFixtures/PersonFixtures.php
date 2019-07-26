<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=1;$i<10;$i++){
            $person = new Person();
            $person->setName("test".$i)->setMail("test".$i."@gmail.com")->setPassword("test".$i)->setPhoneNumber("076800281".$i);
            $manager->persist($person);
        }

        $manager->flush();
    }
}
