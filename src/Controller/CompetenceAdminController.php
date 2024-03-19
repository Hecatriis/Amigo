<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/competence')]
class CompetenceAdminController extends AbstractController
{
    #[Route('/', name: 'app_competence_admin_index', methods: ['GET'])]
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('_ADMIN/competence_admin/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competence_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($competence);
            $entityManager->flush();

            return $this->redirectToRoute('app_competence_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/competence_admin/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_admin_show', methods: ['GET'])]
    public function show(Competence $competence): Response
    {
        return $this->render('_ADMIN/competence_admin/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competence_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_competence_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/competence_admin/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_competence_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
