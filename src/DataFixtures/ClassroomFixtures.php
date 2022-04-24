<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassroomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $classroom = new Classroom();
            $classroom->setName("GCH0901 $i");
        }

        $manager->flush();
    }
}
