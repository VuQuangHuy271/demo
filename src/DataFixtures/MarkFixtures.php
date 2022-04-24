<?php

namespace App\DataFixtures;

use App\Entity\Mark;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarkFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $mark = new Mark();
            $mark->setMark(rand(1, 10));
            $manager->persist($mark);
        }

        $manager->flush();
    }
}
