<?php

namespace App\DataFixtures;

use App\Entity\Semester;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SemesterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $semester = new Semester();
            $semester->setName("Semester $i");
            $semester->setDateStart(DateTime::createFromFormat('Y-m-d', '2020-01-01'));
            $semester->setDateEnd(DateTime::createFromFormat('Y-m-d', '2020-02-14'));
            $manager->persist(($semester));
        }

        $manager->flush();
    }
}
