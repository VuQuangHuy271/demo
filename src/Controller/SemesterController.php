<?php

namespace App\Controller;

use App\Entity\Semester;
use App\Form\SemesterType;
use App\Repository\SemesterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/semester')]
class SemesterController extends AbstractController
{
    #[Route('/', name: 'semester_index')]
    public function semesterIndex(ManagerRegistry $registry)
    {
        $semesters = $registry->getRepository(Semester::class)->findAll(); 
        return $this->render('semester/index.html.twig', [
            'semesters' => $semesters
        ]);
    }
    #[Route('/detail/{id}', name: 'semester_detail')]
    public function semesterDetail(ManagerRegistry $registry, $id)
    {
        $semester = $registry->getRepository(Semester::class)->find($id);
        if ($semester == null) {
            $this->addFlash('error', 'Semester not found');
            return $this->redirectToRoute('semester_detail');
        }
        return $this->render('semester/detail.html.twig', [
            'semester' => $semester
        ]);
    }
    #[Route('/delete/{id}', name: 'semester_delete')]
    public function semesterDelete(ManagerRegistry $registry, $id){
        $semesters = $registry->getRepository(Semester::class)->find($id);
        $manager = $registry->getManager();
        $manager->remove($semesters);
        $manager->flush();
        $this->addFlash('Success!!', 'Semester is deleted');
        return $this->redirectToRoute('semester_index');
    }
    #[Route('/add', name: 'semester_add')]
    public function semesterAdd(Request $request, ManagerRegistry $registry){
        $semester = new Semester();
        $form = $this->createForm(SemesterType::class, $semester);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager -> persist($semester);
            $manager -> flush();
            $this->addFlash('Success', 'Add semester successfull !!');
            return $this->redirectToRoute("semester_index");
        }
        return $this->renderForm('semester/add.html.twig',
                                [
                                    'semesterForm' => $form
                                ]);

    }
    #[Route('edit/{id}', name: 'semester_edit')]
    public function semesterEdit(Request $request ,ManagerRegistry $registry, $id){
        $semester = $registry->getRepository(Semester::class)->find($id);
        $form = $this->createForm(SemesterType::class, $semester);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager -> persist($semester);
            $manager -> flush();
            $this->addFlash('Success', 'Add semester successfull !!');
            return $this->redirectToRoute("semester_index");
        }
        return $this->renderForm('semester/edit.html.twig',
                                [
                                    'semesterForm' => $form
                                ]);

    }
    #[Route('/search', name: 'semester_search')]
    public function search(Request $request ,SemesterRepository $semesterRepository){
        $keyword = $request->get('name');
        $semesters = $semesterRepository->searchSemester($keyword);
        return $this->render('semester/index.html.twig', 
                            [
                                'semesters' => $semesters,
                            ]);
    }
}
