<?php

namespace App\Controller;


use App\Entity\Classroom;

use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ClassroomAddDetailType;
#[Route("/classroom")]
class ClassroomController extends AbstractController
{
   //ManagerRegistry $doctrine số yêu cầu Symfony đưa dịch vụ Doctrine vào phương thức controller.
   #[Route('/', name: "classroom_index")]
   public function classroom_index(ManagerRegistry $registry){
      $classroom = $registry -> getRepository(Classroom::class) -> findAll();
         return $this->render('classroom/index.html.twig', [
         'classroom' => $classroom,
         ]);
   }

   #[Route('/detail/{id}', name: "classroom_detail")]
   public function classroom_detail(ManagerRegistry $registry, $id){
      $classroom = $registry -> getRepository(Classroom::class) -> find($id);
      if($classroom == null){
         $this -> addFlash("Error", "Classroom not found");
         return $this->redirectToRoute('classroom_index');
      }
      return $this -> render('classroom/detail.html.twig',[
         'classroom' => $classroom,
         'id' => $id,
      ]);
   }

   #[Route('add',name: "classroom_add")]
   //ManagerRegistry $doctrine yêu cầu Symfony đưa dịch vụ Doctrine vào phương thức controller.
   public function ClassroomAdd(Request $request, ManagerRegistry $registry){
      $classroom = new Classroom();
      //getRepository() method sẽ trả về một repository cho phép bạn query tới database.
      $form = $this->createForm(ClassroomType::class, $classroom);
      // Để xử lý dữ liệu biểu mẫu, bạn sẽ cần gọi phương thức handleRequest ()
      // Đằng sau, điều này sử dụng một đối tượng NativeRequestHandler để đọc dữ liệu của các 
      // superglobals PHP chính xác (tức là $_POSThoặc $_GET) dựa trên phương thức HTTP được định cấu hình trên biểu mẫu (POST là mặc định).
      $form -> handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
         $manager = $registry->getManager();
         $manager->persist($classroom);
         $manager->flush();
         $this->addFlash('Success', 'classroom added');
         return $this->redirectToRoute('classroom_index');
      }
      return $this->renderForm('classroom/add.html.twig', [
         'ClassroomForm' => $form
      ]);
   }


   #[Route('/addDetail/{id}', name: "classroom_addDetail")]
   public function classroom_addDetail(ManagerRegistry $registry, $id, Request $request){
      $classroom = $registry -> getRepository(Classroom::class) -> find($id);
      if($classroom === null){
         $this -> addFlash('Error', 'Classroom not found');
         return $this -> redirectToRoute('classroom_index');
      }
      $form = $this -> createForm(ClassroomAddDetailType :: class, $classroom);
      $form -> handleRequest($request);
      if($form->isSubmitted() && $form->isValid()) {
         $manager = $registry -> getManager();
         $manager -> persist($classroom);
         $manager -> flush();
         $this->addFlash('Success', 'classroom Detail Added');
         return $this->redirectToRoute('classroom_index');
      }
      return $this->renderForm('classroom/addDetail.html.twig', [
         'ClassroomAddDetailForm' => $form
      ]);
   }


   #[Route('/delete{id}', name: 'classroom_delete')]
      public function deleteStudent($id, ManagerRegistry $registry){
         $classroom = $registry ->getRepository(Classroom::class)->find($id);
         if($classroom == null){
            $this->addFlash("Error","classroom not found !");
         }else{ 
            //$registry->getManager(); lưu các đối tượng vào và tìm nạp các đối tượng từ cơ sở dữ liệu.
            $manager = $registry->getManager();
            $manager->remove($classroom);
            $manager->flush();
            $this->addFlash("Success", "classroom delete succeed !");
         }
         return $this->redirectToRoute("classroom_index",
                        [
                           'classroom' => $classroom,
                        ]);
         }
      #[Route('/search', name: 'classroom_search')]
      public function search (Request $request, ClassroomRepository $classroomRepository, ManagerRegistry $registry) {
         $classroom = $registry->getRepository(Classroom::class)->findAll();
         $keyword = $request->get('name');
         $classroom = $classroomRepository->search($keyword);
         return $this->render("classroom/index.html.twig",
                                 [
                                    'classroom' => $classroom,
                                 ]);
      }
      #[Route('/edit/{id}', name : 'classroom_edit')]
      public function EditClassroom($id, Request $request, ManagerRegistry $registry){
         $classroom = $registry -> getRepository(Classroom::class)-> find($id);
         if($classroom == null){
            $this -> addFlash("Error", "Classroom does not exist");
         }
         $form = $this -> createForm(ClassroomType::class, $classroom);
         $form -> handleRequest($request);
         if($form -> isSubmitted() && $form -> isValid())
         {
            $manager = $registry -> getManager();
            $manager -> persist($classroom);
            $manager -> flush();
            $this->addFlash('Success', 'classroom edited');
            return $this->redirectToRoute('classroom_index');
         }
         return $this->renderForm('classroom/edit.html.twig', [
            'ClassroomForm' => $form
         ]);
      }
}

