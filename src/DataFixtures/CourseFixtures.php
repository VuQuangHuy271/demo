<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i <10; $i++){
            $course = new Course();
            $course-> setName("CNTT $i");
            $course-> setDateStart(\DateTime::createFromFormat('Y-m-d','2022-02-08'));
            $course-> setDateEnd(\DateTime::createFromFormat('Y-m-d','2022-08-08'));
            $course-> setDescription("Cong Nghe Thong Tin $i");
            $manager->persist($course);
        }

        $manager->flush();
    }
}
