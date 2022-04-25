<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixture extends Fixture
{
    public function __construct (UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername("admin$i");
            $user -> setRoles(['ROLE_ADMIN']);
            $user -> setPassword($this->hasher->hashPassword($user,"123456"));
            $manager ->persist($user);
        }
        
        $manager->flush();
    }
}
