<?php

namespace App\Controller;

use App\Entity\Bureau;
use App\Form\BureauType;
use App\Repository\BureauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/bureau')]
class BureauAdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_bureau_admin_index', methods: ['GET'])]
    public function index(BureauRepository $bureauRepository): Response
    {
        return $this->render('_ADMIN/bureau_admin/index.html.twig', [
            'bureaus' => $bureauRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_bureau_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bureau = new Bureau();
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bureau);
            $entityManager->flush();

            return $this->redirectToRoute('app_bureau_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/bureau_admin/new.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_bureau_admin_show', methods: ['GET'])]
    public function show(Bureau $bureau): Response
    {
        return $this->render('_ADMIN/bureau_admin/show.html.twig', [
            'bureau' => $bureau,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_bureau_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var File $file */
            $file = $request->files->get('bureau')['fichier']['file'];

            $bureau->setFichier($file)->setNameFile($file->getFilename());
            $entityManager->flush();

            return $this->redirectToRoute('app_bureau_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/bureau_admin/edit.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_bureau_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bureau->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bureau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bureau_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
