<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/student")]
class StudentController extends AbstractController
{
    #[Route('/', name: 'student_index')]
    public function studentIndex(ManagerRegistry $registry)
    {
        $student = $registry->getRepository(Student::class)->findAll();  
        return $this->render('student/index.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail (ManagerRegistry $registry, $id) {
        $student = $registry->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error","student not found !");
            return $this->redirectToRoute("student_index");
        }
        return $this->render("student/detail.html.twig",
        [
            'student' => $student,
        ]);
    }


    #[Route('/delete/{id}', name: 'student_delete')]
    public function studentDelete (ManagerRegistry $registry, $id) {
        $student = $registry->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash("Error","student not found !");
        } else {
            $manager = $registry->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash("Success", "student delete succeed !");
        }
        return $this->redirectToRoute("student_index",
                        [
                            'student' => $student,
                        ]);
    }

    #[Route('/add', name: 'student_add')]
    public function studentAdd(Request $request, ManagerRegistry $registry){
        $student = new Student;
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager->persist($student);
            $manager->flush();
            $this->addFlash('Success', 'Student added');
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/add.html.twig', [
            'StudentForm' => $form
        ]);
    }
    
    #[Route('/edit/{id}', name: 'student_edit')]
    public function studentEdit(Request $request, ManagerRegistry $registry, $id){
        $student = $registry->getRepository(Student::class)->find($id);
        if($student == null){
            $this->addFlash('Error', 'Student not found');
            return $this->redirectToRoute('student_index');
        }
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager->persist($student);
            $manager->flush();
            $this->addFlash('Success', 'Student edited');
            return $this->redirectToRoute('student_index');
        }
        return $this->renderForm('student/edit.html.twig', [
            'StudentForm' => $form
        ]);
    }


    // #[Route('/filter/{id}', name: 'student_filter')]
    // public function filter ($id, ManagerRegistry $registry) {
    //     $course = $registry->getRepository(Course::class)->findAll();
    //     $course = $registry->getRepository(Course::class)->find($id);
    //     $student = $course->getStudent();
    //     return $this->render("student/index.html.twig",
    //                             [
    //                                     'student' => $student,
    //                                     'course' => $course
    //                             ]);
    // }

    #[Route('/search', name: 'student_search')]
    public function search (Request $request, StudentRepository $studentRepository, ManagerRegistry $registry) {
        $course = $registry->getRepository(Course::class)->findAll();
        $keyword = $request->get('name');
        $students = $studentRepository->search($keyword);
        return $this->render("student/index.html.twig",
                                [
                                    'student' => $students,
                                    'course' => $course
                                ]);
    }

    // #[Route('/asc', name: 'student_asc')]
    // public function sortAsc(StudentRepository $studentRepository, ManagerRegistry $registry) {
    //     $course = $registry->getRepository(Course::class)->findAll();
    //     $student = $studentRepository->sortStudentAsc();
    //     return $this->render("student/index.html.twig",
    //                             [
    //                                 'student' => $student,
    //                                 'course' => $course
    //                             ]);
    // }
    // #[Route('/desc', name: 'student_desc')]
    // public function sortDesc(StudentRepository $studentRepository, ManagerRegistry $registry){
    //     $course = $registry->getRepository(Course::class)->findAll();
    //     $student = $studentRepository->sortStudentDESC();
    //     return $this ->render("student/index.html.twig",
    //     [
    //         'student' => $student,
    //         'course' => $course
    //     ]);
    // }

    
    // #[Route('/filter/{id}', name: 'student_filter')]
    // public function filter ($id, ManagerRegistry $registry) {
    //     $courses = $registry->getRepository(Course::class)->findAll();
    //     $course = $registry->getRepository(Course::class)->find($id);
    //     $student = $course->getStudent();
    //     return $this->render("student/index.html.twig",
    //                             [
    //                                     'student' => $student,
    //                                     'course' => $courses
    //                             ]);
    // }

}
