<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Entity\PartenaireAnnuelle;
use App\Entity\PartenaireEntreprise;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Naming\SmartUniqueNamer;

#[Route('/admin/partenaire')]
class PartenaireAdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_partenaire_admin_index', methods: ['GET'])]
    public function index(PartenaireRepository $partenaireRepository): Response
    {
        return $this->render('_ADMIN/partenaire_admin/index.html.twig', [
            'partenaires' => $partenaireRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_partenaire_admin_new')]
    public function showNew(): Response
    {
        return $this->render('_ADMIN/partenaire_admin/new.html.twig');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/create', name: 'app_partenaire_admin_create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UploadHandler $upload): Response
    {
        $type = $request->request->get("choix");
        $entity = null;
        if ($type == "partenaire") {
            $entity = new PartenaireEntreprise();
        }
        else {
            $entity = new PartenaireAnnuelle();
        }

        $file = $request->files->get('image');

        $entity->setDescription($request->request->get("description"))
            ->setVille($request->request->get("ville"))
            ->setAdresse($request->request->get("adresse"))
            ->setCodePostal($request->request->get("codePostal"))
            ->setSiteWeb($request->request->get("link"))
            ->setNomEntreprise($request->request->get("nom"))
            ->setFichier($file)
            ->setNameFile($file->getFilename())
        ;
        $entityManager->persist($entity);
        $entityManager->flush();

        return $this->redirectToRoute("app_partenaire_admin_index");
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_partenaire_admin_show', methods: ['GET'])]
    public function show(Partenaire $partenaire): Response
    {
        return $this->render('_ADMIN/partenaire_admin/show.html.twig', [
            'partenaire' => $partenaire,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_partenaire_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partenaire $partenaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var File $file */
            $file = $request->files->get('partenaire')['fichier']['file'];
            $partenaire->setFichier($file)->setNameFile($file->getFilename());

            $entityManager->flush();

            return $this->redirectToRoute('app_partenaire_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('_ADMIN/partenaire_admin/edit.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_partenaire_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Partenaire $partenaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partenaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($partenaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_partenaire_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
