<?php

namespace App\Entity;

use App\Entity\Mark;
use App\Entity\Teacher;
use App\Entity\Classroom;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Teacher::class, inversedBy: 'subjects')]
    private $teacher;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Mark::class)]
    private $marks;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Classroom::class)]
    private $classroom;

    public function __construct()
    {
        $this->marks = new ArrayCollection();
        $this->classroom = new ArrayCollection();
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

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Mark $mark): self
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setSubject($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): self
    {
        if ($this->marks->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getSubject() === $this) {
                $mark->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classroom>
     */
    public function getClassroom(): Collection
    {
        return $this->classroom;
    }

    public function addClassroom(Classroom $classroom): self
    {
        if (!$this->classroom->contains($classroom)) {
            $this->classroom[] = $classroom;
            $classroom -> setSubject($this);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): self
    {
        if ($this->classroom->removeElement($classroom)) {
            // set the owning side to null (unless already changed)
            if ($classroom->getSubject() === $this) {
                $classroom->setSubject(null);
            }
        }
        return $this;
    }


}