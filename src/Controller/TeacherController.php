<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/teacher")]
class TeacherController extends AbstractController
{
    #[Route('/', name: 'teacher_index')]
    public function teacherIndex(ManagerRegistry $registry)
    {
        $teacher = $registry->getRepository(Teacher::class)->findAll();  
        return $this->render('teacher/index.html.twig', [
            'teacher' => $teacher,
        ]);
    }

    #[Route('/detail/{id}', name: 'teacher_detail')]
    public function teacherDetail (ManagerRegistry $registry, $id) {
        $teacher = $registry->getRepository(Teacher::class)->find($id);
        if ($teacher == null) {
            $this->addFlash("Error","teacher not found !");
            return $this->redirectToRoute("teacher_index");
        }
        return $this->render("teacher/detail.html.twig",
        [
            'teacher' => $teacher,
        ]);
    }


    #[Route('/delete/{id}', name: 'teacher_delete')]
    public function teacherDelete (ManagerRegistry $registry, $id) {
        $teacher = $registry->getRepository(Teacher::class)->find($id);
        if ($teacher == null) {
            $this->addFlash("Error","teacher not found !");
        } else if(count($teacher->getSubjects()) > 0){
            $this -> addFlash("Error", "can not delete this teacher");
        }else{
            $manager = $registry->getManager();
            $manager->remove($teacher);
            $manager->flush();
            $this->addFlash("Success", "teacher delete succeed !");
        }
        return $this->redirectToRoute("teacher_index",
                        [
                            'teacher' => $teacher,
                        ]);
    }

    #[Route('/add', name: 'teacher_add')]
    public function teacherAdd(Request $request, ManagerRegistry $registry){
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager->persist($teacher);
            $manager->flush();
            $this->addFlash('Success', 'teacher added');
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/add.html.twig', [
            'TeacherForm' => $form
        ]);
    }
    
    #[Route('/edit/{id}', name: 'teacher_edit')]
    public function teacherEdit(Request $request, ManagerRegistry $registry, $id){
        $teacher = $registry->getRepository(Teacher::class)->find($id);
        if($teacher == null){
            $this->addFlash('Error', 'teacher not found');
            return $this->redirectToRoute('teacher_index');
        }
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager->persist($teacher);
            $manager->flush();
            $this->addFlash('Success', 'teacher edited');
            return $this->redirectToRoute('teacher_index');
        }
        return $this->renderForm('teacher/edit.html.twig', [
            'TeacherForm' => $form
        ]);
    }


    #[Route('/search', name: 'teacher_search')]
    public function search (Request $request, TeacherRepository $teacherRepository, ManagerRegistry $registry) {
        $course = $registry->getRepository(Course::class)->findAll();
        $keyword = $request->get('name');
        $teachers = $teacherRepository->search($keyword);
        return $this->render("teacher/index.html.twig",
                                [
                                    'teacher' => $teachers,
                                    'course' => $course
                                ]);
    }
    #[Route('/Desc', name: 'DescTeacher')]
    public function AscTeacher(TeacherRepository $teacherRepository, ManagerRegistry $registry){
        $teacher = $registry -> getRepository(Teacher::class)->findAll();
        $teacher = $teacherRepository->Desc();
        return $this -> render('teacher/index.html.twig',[
            'teacher' => $teacher,
        ]);
    }
}
