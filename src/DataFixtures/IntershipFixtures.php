<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use App\Entity\Internship;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class IntershipFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $internship = new Internship();
            $internship->setName($faker->text($maxNbChars = 10));
            $internship->setDescription($faker->text($maxNbChars = 200));
            $internship->setStartDate($faker->date($format = 'd-m-Y', $max = 'now'));
            $internship->setPicture($faker->imageUrl($width = 640, $height = 480, 'nightlife'));
            $manager->persist($internship);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Inscription::class];
    }
}