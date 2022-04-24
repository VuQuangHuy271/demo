<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarksController extends AbstractController
{
    #[Route('/marks', name: 'app_marks')]
    public function index(): Response
    {
        return $this->render('marks/index.html.twig', [
            'controller_name' => 'MarksController',
        ]);
    }
}
