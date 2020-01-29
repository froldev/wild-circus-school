<?php

namespace App\DataFixtures;

use App\Entity\SchoolClass;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setCivility('Monsieur');
        $user->setFirstName('OLIVE');
        $user->setLastName('Fred');
        $user->setEmail('admin@site.fr');
        $user->setPassword('admin');
        $user->setRoles([User::ROLE_ADMIN]);
        $manager->persist($user);

        $user = new User();
        $user->setCivility('Madame');
        $user->setFirstName('MARTIN');
        $user->setLastName('Lucie');
        $user->setEmail('user@site.fr');
        $user->setPassword('user');
        $user->setRoles([User::ROLE_USER]);
        $manager->persist($user);

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setCivility($faker->title);
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setRoles([User::ROLE_USER]);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SchoolClass::class];
    }
}