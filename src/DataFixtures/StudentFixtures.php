<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for($i = 0; $i <= 10; $i++){
            $student = new Student();
            $student -> setName("Test $i");
            $student->setGender("Male");
            $student->setDateOfBirth(\DateTime::createFromFormat('Y-m-d','2022-02-08'));
            $student->setPhone(100);
            $student->setImage("https://marketplace.canva.com/EAD7WuSVrt0/1/0/1003w/canva-colorful-illustration-young-adult-book-cover-LVthABb24ik.jpg");
            $student -> setEmail("email$i@gmail.com");
            $manager->persist($student);
        }
        $manager->flush();
    }
}
