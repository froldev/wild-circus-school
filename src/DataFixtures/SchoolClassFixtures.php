<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\SchoolClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SchoolClassFixtures extends Fixture
{
    const NUMBER_CLASS = 8;

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < $this::NUMBER_CLASS; $i++) {
            $schoolClass = new SchoolClass();
            $schoolClass->setName($faker->text($maxNbChars = 10));
            $schoolClass->setDuration($faker->numberBetween($min = 4, $max = 24));
            $schoolClass->setPrice($faker->numberBetween($min = 1000, $max = 8000));
            $schoolClass->setDescription($faker->text($maxNbChars = 200));
            $schoolClass->setPicture($faker->imageUrl($width = 400, $height = 400));
            $schoolClass->setStartDate($faker->dateTime($max = 'now', $timezone = null));
            $schoolClass->setCategory($this->getReference('category_'.rand(0, 9), $schoolClass));
            $manager->persist($schoolClass);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Artist::class];
    }
}