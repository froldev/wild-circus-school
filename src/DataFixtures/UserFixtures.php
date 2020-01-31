<?php

namespace App\DataFixtures;

use App\Entity\SchoolClass;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setCivility('Monsieur');
        $user->setFirstName('OLIVE');
        $user->setLastName('Fred');
        $user->setEmail('admin@site.fr');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles([User::ROLE_ADMIN]);
        $manager->persist($user);

        $user = new User();
        $user->setCivility('Madame');
        $user->setFirstName('MARTIN');
        $user->setLastName('Lucie');
        $user->setEmail('user@site.fr');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $user->setRoles([User::ROLE_USER]);
        $manager->persist($user);

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setCivility($faker->title);
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $faker->password
            ));
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