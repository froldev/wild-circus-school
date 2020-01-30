<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

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

        foreach(self::CATEGORIES as $cat) {
            $category = new Category();
            $category->setName($cat);
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Artist::class];
    }
}