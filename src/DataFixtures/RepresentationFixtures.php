<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use App\Entity\Representation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RepresentationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $representation = new Representation();
            $representation->setName($faker->text($maxNbChars = 10));
            $representation->setDescription($faker->text($maxNbChars = 200));
            $representation->setStartDate($faker->date($format = 'd-m-Y', $max = 'now'));
            $representation->setPicture($faker->imageUrl($width = 640, $height = 480, 'business'));
            $manager->persist($representation);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Inscription::class];
    }
}