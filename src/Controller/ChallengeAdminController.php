<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Form\ChallengeType;
use App\Repository\ChallengeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/challenge')]
class ChallengeAdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_challenge_admin_index', methods: ['GET'])]
    public function index(ChallengeRepository $challengeRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $challenges = $paginator->paginate(
            $challengeRepository->findAllOrderedByDate(),
            $request->query->getInt('pages', 1),
            10
        );
        return $this->render('_ADMIN/challenge_admin/index.html.twig', [
            'challenges' => $challenges,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_challenge_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $challenge = new Challenge();
        $form = $this->createForm(ChallengeType::class, $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($challenge);
            $entityManager->flush();

            return $this->redirectToRoute('app_challenge_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/challenge_admin/new.html.twig', [
            'challenge' => $challenge,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_challenge_admin_show', methods: ['GET'])]
    public function show(Challenge $challenge): Response
    {
        return $this->render('_ADMIN/challenge_admin/show.html.twig', [
            'challenge' => $challenge,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_challenge_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Challenge $challenge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChallengeType::class, $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var File $file */
            $file = $request->files->get('challenge')['fichier']['file'];
            $challenge->setFichier($file)->setNameFile($file->getFilename());
            $entityManager->flush();

            return $this->redirectToRoute('app_challenge_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/challenge_admin/edit.html.twig', [
            'challenge' => $challenge,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_challenge_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Challenge $challenge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$challenge->getId(), $request->request->get('_token'))) {
            $entityManager->remove($challenge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_challenge_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
