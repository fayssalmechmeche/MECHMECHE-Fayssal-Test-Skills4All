<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 20; $i++) {
            $faker = Factory::create();
            $car = new Car();
            $car->setName($faker->name());
            $car->setNbSeats($faker->randomElement([1, 2, 3, 4]));
            $car->setNbDoors($faker->randomElement([1, 2, 3, 4]));
            $car->setCost($faker->randomDigitNotNull());
            $manager->persist($car);
        }
        $manager->flush();
    }
}