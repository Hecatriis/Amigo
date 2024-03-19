<?php

namespace App\Controller;

use App\Repository\ChallengeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeController extends AbstractController
{
    #[Route('/challenge', name: 'app_challenge')]
    public function index(ChallengeRepository $repository): Response
    {
        return $this->render('challenge/index.html.twig', [
            'challenges' => $repository->findAllOrderedByDate(),
        ]);
    }
}
