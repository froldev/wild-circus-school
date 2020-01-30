<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use App\Entity\Internship;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class InternshipFixtures extends Fixture
{

    const INTERNSHIP = [
        'Cirque du Soleil', '', '', 'https://s1.qwant.com/thumbr/0x380/8/c/3197ef98e36907431df793dcbbe1fd31d0a0b4b1458c48846ebfdb46c4da6e/1200px-Cirquedesoleil-logo.svg.png?u=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fsq%2Fthumb%2F8%2F88%2FCirquedesoleil-logo.svg%2F1200px-Cirquedesoleil-logo.svg.png',
        'Cirque Gruss', '', '', '',
        'Cirque Pinder', '', '', '',
        'Cirque Bouglione', '', '', '',
        'Cirque Medrano', '', '', '',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $internship = new Internship();
            $internship->setName($faker->text($maxNbChars = 10));
            $internship->setDescription($faker->text($maxNbChars = 200));
            $internship->setStartDate($faker->dateTime($max = 'now', $timezone = null));
            $internship->setImage($faker->imageUrl($width = 640, $height = 480, 'nightlife'));
            $manager->persist($internship);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [Inscription::class];
    }
}