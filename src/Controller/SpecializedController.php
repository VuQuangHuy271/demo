<?php

namespace App\Controller;


use App\Entity\Specialized;

use App\Form\SpecializedType;
use App\Repository\SpecializedRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route("/specialized")]
class SpecializedController extends AbstractController
{
   //ManagerRegistry $doctrine số yêu cầu Symfony đưa dịch vụ Doctrine vào phương thức controller.
    #[Route('/', name: "specialized_index")]
    public function specialized_index(ManagerRegistry $registry){
        $specialized = $registry -> getRepository(Specialized::class) -> findAll();
        return $this->render('specialized/index.html.twig', [
            'specialized' => $specialized,
            ]);
    }

    #[Route('/detail/{id}', name: "specialized_detail")]
    public function specialized_detail(ManagerRegistry $registry, $id){
        $specialized = $registry -> getRepository(Specialized::class) -> find($id);
        if($specialized == null){
            $this -> addFlash("Error", "Specialized not found");
            return $this->redirectToRoute('specialized_index');
        }
        return $this -> render('specialized/detail.html.twig',[
            'specialized' => $specialized,
            'id' => $id,
        ]);
    }

    #[Route('add',name: "specialized_add")]
    public function specializedAdd(Request $request, ManagerRegistry $registry){
        $specialized = new Specialized();
        $form = $this->createForm(SpecializedType::class, $specialized);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $registry->getManager();
            $manager->persist($specialized);
            $manager->flush();
            $this->addFlash('Success', 'Specialized added');
            return $this->redirectToRoute('specialized_index');
        }
        return $this->renderForm('specialized/add.html.twig', [
            'SpecializedForm' => $form
        ]);
    } 


    #[Route('/delete{id}', name: 'specialized_delete')]
    public function deleteStudent($id, ManagerRegistry $registry){
        $specialized = $registry ->getRepository(specialized::class)->find($id);
        
        if($specialized == null){
            $this->addFlash("Error","specialized not found !");
            //check xem specialized cần xóa có tồn tại tối thiểu 1 student hoặc 1 teacher hay không
            //nếu có thì không cho xóa và thông báo lỗi
        }else if (count($specialized->getStudent()) >= 1 || count($specialized->getTeachers()) >= 1) {
            $this->addFlash("Error", "Can not delete this specialized !");
        }else{ 
            //$registry->getManager(); lưu các đối tượng vào và tìm nạp các đối tượng từ cơ sở dữ liệu.
            $manager = $registry->getManager();
            $manager->remove($specialized);
            $manager->flush();
            $this->addFlash("Success", "specialized delete succeed !");
        }
        return $this->redirectToRoute("specialized_index");
        }
    #[Route('/search', name: 'specialized_search')]
    public function search (Request $request, SpecializedRepository $specializedRepository, ManagerRegistry $registry) {
        $specialized = $registry->getRepository(Specialized::class)->findAll();
        $keyword = $request->get('name');
        $specialized = $specializedRepository->search($keyword);
        return $this->render("specialized/index.html.twig",
                                [
                                    'specialized' => $specialized,
                                ]);
    }
    #[Route('/edit/{id}', name : 'specialized_edit')]
    public function EditSpecialized($id, Request $request, ManagerRegistry $registry){
        $specialized = $registry -> getRepository(Specialized::class)-> find($id);
        if($specialized == null){
            $this -> addFlash("Error", "Specialized does not exist");
        }
        $form = $this -> createForm(SpecializedType::class, $specialized);
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid())
        {
            $manager = $registry -> getManager();
            $manager -> persist($specialized);
            $manager -> flush();
            $this->addFlash('Success', 'Specialized edited');
            return $this->redirectToRoute('specialized_index');
        }
        return $this->renderForm('specialized/edit.html.twig', [
            'SpecializedForm' => $form
        ]);
    }
}

