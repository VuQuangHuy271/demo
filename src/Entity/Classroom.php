<?php

namespace App\Entity;

use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Subject::class, inversedBy: 'classroom')]
    private $subject;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'classrooms')]
    private $student;

    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }


    /**
     * @return Collection<int, student>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(student $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student[] = $student;
        }

        return $this;
    }

    public function removeStudent(student $student): self
    {
        $this->student->removeElement($student);

        return $this;
    }
}