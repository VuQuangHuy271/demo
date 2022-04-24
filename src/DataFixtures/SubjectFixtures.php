<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $subject = new Subject();
            $subject->setName("Computing $i");
            $subject->setDescription("Computing Reseach 1931 parts 2");
            $subject->setImage("https://m.media-amazon.com/images/I/41Zfgv5gtwL.jpg");
            $manager->persist($subject);
        }

        $manager->flush();
    }
}
