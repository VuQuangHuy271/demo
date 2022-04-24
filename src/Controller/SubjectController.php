<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/subject')]
class SubjectController extends AbstractController
{
    #[Route('/', name: 'subject_index')]
    public function subjectIndex(ManagerRegistry $registry)
    {
        $subjects = $registry->getRepository(Subject::class)->findAll();
        return $this->render('subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }
    #[Route('/delete/{id}', name: 'subject_delete')]
    public function subjectDelete(ManagerRegistry $registry, $id){
        $subjects = $registry->getRepository(Subject::class)->find($id);
        $manager = $registry->getManager();
        $manager->remove($subjects);
        $manager->flush();
        $this->addFlash('Success!!', 'Subject is deleted');
        return $this->redirectToRoute('subject_index');
    }
    #[Route('/add', name: 'subject_add')]
    public function subjectAdd(Request $request, ManagerRegistry $registry){
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager -> persist($subject);
            $manager -> flush();
            $this->addFlash('Success', 'Add subject successfull !!');
            return $this->redirectToRoute("subject_index");
        }
        return $this->renderForm('subject/add.html.twig',
                                [
                                    'subjectForm' => $form
                                ]);

    }
    #[Route('edit/{id}', name: 'subject_edit')]
    public function subjectEdit(Request $request ,ManagerRegistry $registry, $id){
        $subject = $registry->getRepository(Subject::class)->find($id);
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager -> persist($subject);
            $manager -> flush();
            $this->addFlash('Success', 'Add subject successfull !!');
            return $this->redirectToRoute("subject_index");
        }
        return $this->renderForm('subject/edit.html.twig',
                                [
                                    'subjectForm' => $form
                                ]);

    }
}
