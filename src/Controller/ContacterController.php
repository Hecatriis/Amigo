<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContacterController extends AbstractController
{
    #[Route('/contacter', name: 'app_contacter')]
    public function index(): Response
    {
        return $this->render('contacter/index.html.twig', [

        ]);
    }
}
