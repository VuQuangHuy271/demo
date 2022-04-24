<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i <= 10; $i++){
            $teacher = new Teacher();
            $teacher -> setName("Test $i");
            $teacher->setGender("Male");
            $teacher->setDateOfBirth(\DateTime::createFromFormat('Y-m-d','1990-02-07'));
            $teacher->setPhone(100);
            $teacher->setImage("https://marketplace.canva.com/EAD7WuSVrt0/1/0/1003w/canva-colorful-illustration-young-adult-book-cover-LVthABb24ik.jpg");
            $teacher -> setEmail("Teacher$i@gmail.com");
            $teacher -> setStatus("is Active");
            $manager->persist($teacher);
        }
        $manager->flush();
    }
}