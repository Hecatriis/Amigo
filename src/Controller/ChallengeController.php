<?php

namespace App\Controller;

use App\Repository\ChallengeRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeController extends AbstractController
{
    #[Route('/challenge', name: 'app_challenge')]
    public function index(ChallengeRepository $repository, Session $session, ContentRepository $contentRepository): Response
    {
        if ($session->get('content') === null)
            $session->set('content', $contentRepository->findAll()[0]);

        return $this->render('challenge/index.html.twig', [
            'challenges' => $repository->findAllOrderedByDate(),
        ]);
    }
}
