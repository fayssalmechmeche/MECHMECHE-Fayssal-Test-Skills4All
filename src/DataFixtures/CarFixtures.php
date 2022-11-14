<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\CarCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();


        for ($i = 0; $i < 5; $i++) {
            $carCategory = new CarCategory();
            $carCategory->setName($faker->name());
            $manager->persist($carCategory);
        }
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
            $car = new Car();


            $number = $faker->randomElement([1, 2, 3, 4]);
            $car->setName($faker->name());
            $car->setNbSeats($number);
            $car->setNbDoors($number);
            $car->setCost($faker->randomDigitNotNull());
            $car->setCategory($carCategory);


            $manager->persist($car);
        }
        $manager->flush();
    }
}
