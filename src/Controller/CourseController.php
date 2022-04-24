<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/course")]
class CourseController extends AbstractController
{
    #[Route('/', name: 'course_index')]
    public function courseIndex(ManagerRegistry $registry)
    {
        $course = $registry->getRepository(Course::class)->findAll();
        return $this->render('course/index.html.twig', [
            'course' => $course,
        ]);
    }

    #[Route('/detail/{id}', name: 'course_detail')]
    public function courseDetail(ManagerRegistry $registry, $id)
    {
        $course = $registry->getRepository(Course::class)->find($id);
        if ($course == null) {
            $this->addFlash("Error", "course not found !");
            return $this->redirectToRoute("course_index");
        }
        return $this->render("course/detail.html.twig",
        [
            'course' => $course,
        ]);
    }

    #[Route('/delete/{id}', name: 'course_delete')]
    public function courseDelete(ManagerRegistry $registry, $id)
    {
        $course = $registry->getRepository(Course::class)->find($id);
        if ($course == null) {
            $this->addFlash("Error", "course not found !");
        } else {
            $manager = $registry->getManager();
            $manager->remove($course);
            $manager->flush();
            $this->addFlash("Success", "course delete succeed !");
        }
        return $this->redirectToRoute("course_index",
                        [
                            'course' => $course,
                        ]);
    }

    #[Route('/add', name: 'course_add')]
    public function courseAdd(Request $request, ManagerRegistry $registry)
    {
        $course = new Course;
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $registry->getManager();
            $manager->persist($course);
            $manager->flush();
            $this->addFlash("Success", "course add succeed !");
            return $this->redirectToRoute("course_index");
        }
        return $this->renderForm('course/add.html.twig', [
            'CourseForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'course_edit')]
    public function courseEdit(Request $request, ManagerRegistry $registry, $id)
    {
        $course = $registry->getRepository(Course::class)->find($id);
        if ($course == null) {
            $this->addFlash("Error", "course not found !");
            return $this->redirectToRoute("course_index");
        }
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $registry->getManager();
            $manager->persist($course);
            $manager->flush();
            $this->addFlash("Success", "course edit succeed !");
            return $this->redirectToRoute("course_index");
        }
        return $this->renderForm('course/edit.html.twig', [
            'CourseForm' => $form
        ]);
    }
}
