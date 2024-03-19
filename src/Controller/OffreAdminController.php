<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/offre')]
class OffreAdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_offre_admin_index', methods: ['GET'])]
    public function index(OffreRepository $offreRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $offres = $paginator->paginate(
            $offreRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('_ADMIN/offre_admin/index.html.twig', [
            'offres' => $offres,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_offre_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/offre_admin/new.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_offre_admin_show', methods: ['GET'])]
    public function show(Offre $offre): Response
    {
        return $this->render('_ADMIN/offre_admin/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_offre_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/offre_admin/edit.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_offre_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
