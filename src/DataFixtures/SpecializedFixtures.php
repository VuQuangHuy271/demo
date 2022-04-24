<?php

namespace App\DataFixtures;

use App\Entity\Specialized;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SpecializedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i <= 5; $i++){
            $specialized = new Specialized();
            $specialized -> setName("specialized $i");
            $specialized -> setDescription("description $i");
            $manager -> persist($specialized);
        }

        $manager->flush();
    }
}