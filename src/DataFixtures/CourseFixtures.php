<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++){
            $course = new Course();
            $course-> setName("course $i");
            $course-> setDateStart(\DateTime::createFromFormat('Y-m-d','2022-02-08'));
            $course-> setDateEnd(\DateTime::createFromFormat('Y-m-d','2022-08-08'));
            $course-> setDescription("Description $i");
            $manager->persist($course);
        }

        $manager->flush();
    }
}
