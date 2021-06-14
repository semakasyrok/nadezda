<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixture extends Fixture
{
    public function __construct(
        protected UserPasswordHasherInterface $passwordEncoder,
        protected string $adminPassword
    ) {}

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@admin.ru');
        $user->setPassword($this->passwordEncoder->hashPassword(
            $user,
            $this->adminPassword,
        ));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
