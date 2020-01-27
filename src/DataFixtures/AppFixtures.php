<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Cars;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 5; $i++) {
            $car = new Cars();
            $car->setBrand('brand '.$i);
            $car->setModel('model '.$i);
            $car->setColor('color '.$i);
            $car->setPrice(mt_rand(10000, 10000) . ' DHS');
            $manager->persist($car);
        }
        $manager->flush();
    }
}
