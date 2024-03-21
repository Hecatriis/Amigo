<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConditionGeneraleController extends AbstractController
{
    #[Route('/conditions', name: 'app_condition_generale')]
    public function index(): Response
    {
        return $this->render('condition_generale/index.html.twig', [

        ]);
    }
}
