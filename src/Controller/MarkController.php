<?php

namespace App\Controller;

use App\Entity\Mark;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/mark')]
class MarkController extends AbstractController
{
    #[Route('/', name: 'mark_index')]
    public function markIndex(ManagerRegistry $registry)
    {
        $marks = $registry->getRepository(Mark::class)->findAll();
        return $this->render('mark/index.html.twig', [
            'marks' => $marks
        ]);
    }
}
