<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use App\Entity\SchoolClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $partner = new Partner();
            $partner->setName($faker->name);
            $partner->setPicture($faker->imageUrl($width = 400, $height = 400));
            $partner->setLink($faker->url);
            $manager->persist($partner);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SchoolClass::class];
    }
}