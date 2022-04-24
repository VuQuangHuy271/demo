<?php

namespace App\DataFixtures;

use App\Entity\Mark;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MarkFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $mark = new Mark();
            $mark->setAssignment1(rand(1, 10));
            $mark->setAssignment2(rand(1, 10));
            $manager->persist($mark);
        }

        $manager->flush();
    }
}
