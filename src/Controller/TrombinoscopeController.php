<?php

namespace App\Controller;

use App\Repository\BureauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    #[Route('/trombinoscope', name: 'app_trombinoscope')]
    public function index(BureauRepository $bureauRepository): Response
    {
        $membresBureau = $bureauRepository->findAll();
        return $this->render('trombinoscope/index.html.twig', [
            'leBureau' => $membresBureau,
            'nbElem' => sizeof($membresBureau)
        ]);
    }
}
