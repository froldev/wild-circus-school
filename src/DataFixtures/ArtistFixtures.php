<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\SchoolClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 6; $i++) {
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setDescription($faker->text($maxNbChars = 200));
            $artist->setPicture($faker->imageUrl($width = 640, $height = 480, 'people'));
            $manager->persist($artist);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SchoolClass::class];
    }
}