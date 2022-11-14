<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CarCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 5; $i++) {
            $faker = Factory::create();
            $carCategory = new CarCategory();
            $carCategory->setName($faker->name());
            $manager->persist($carCategory);
        }
        $manager->flush();
    }
}
