<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'acrobatic',
        'balancing',
        'clown',
        'contortion',
        'equestrian',
        'fakir',
        'illusionism',
        'juggling',
        'mimic',
        'ventriloquist'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $i = 0;
        foreach(self::CATEGORIES as $cat) {
            $category = new Category();
            $category->setName($cat);
            $category->setImage($faker->imageUrl($width = 640, $height = 480));
            $manager->persist($category);
            $this->addReference('category_' .$i, $category);
            $i++;
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Artist::class];
    }
}