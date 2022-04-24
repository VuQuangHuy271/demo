<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SemesterController extends AbstractController
{
    #[Route('/semester', name: 'app_semester')]
    public function index(): Response
    {
        return $this->render('semester/index.html.twig', [
            'controller_name' => 'SemesterController',
        ]);
    }
}
