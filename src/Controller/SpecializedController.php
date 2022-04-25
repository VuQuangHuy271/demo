<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecializedController extends AbstractController
{
    #[Route('/specialized', name: 'app_specialized')]
    public function index(): Response
    {
        return $this->render('specialized/index.html.twig', [
            'controller_name' => 'SpecializedController',
        ]);
    }
}
