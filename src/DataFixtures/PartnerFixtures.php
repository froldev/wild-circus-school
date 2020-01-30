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
        for ($i = 0; $i < 11; $i++) {
            $partner = new Partner();
            $partner->setName($faker->name);
            $partner->setImage($faker->imageUrl($width = 640, $height = 480, 'people'));
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