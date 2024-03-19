<?php

namespace App\Controller;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminTextController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/textes', name: 'app_admin_text')]
    public function textes(): Response
    {
        return $this->render('_ADMIN/admin_text/modif_text.html.twig', [

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/images', name: 'app_admin_image')]
    public function images(): Response
    {
        return $this->render('_ADMIN/admin_text/modif_images.html.twig', [

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/modifImages', name: 'app_admin_image_modif', methods: ['GET', 'POST'])]
    public function modifImages(Request $request, Session $session, ContentRepository $repository,
        EntityManagerInterface $manager): Response
    {
        $icone = $request->files->get('icone');
        $logo = $request->files->get('logo');
        $image = $request->files->get('imageAccueil');

        $content = $repository->findAll()[0];

        if ($icone !== null)
            $content->setIconeSiteName($icone->getFilename())->setIconeSite($icone);

        if ($logo !== null)
            $content->setLogoName($logo->getFilename())->setLogo($logo);

        if ($image !== null)
            $content->setImageAccueilName($image->getFilename())->setImageAccueil($image);

        if ($icone !== null || $logo !== null || $image !== null) {
            dump($content);
            $manager->persist($content);
            $manager->flush();
            $content->setIconeSite(null)->setImageAccueil(null)->setLogo(null);
            dump($content);
            $session->remove('content');
            $session->set('content', $content);
        }
        return $this->redirectToRoute('app_admin_image');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/modifTextes', name: 'app_admin_text_modif', methods: ["POST"])]
    public function modiftextes(Request $request, Session $session, ContentRepository $repository,
        EntityManagerInterface $manager): Response
    {
        $textAccueil = $request->request->get('textAccueil');
        $textPresentation = $request->request->get('textPresentation');
        $content = $repository->findAll()[0];
        $content->setTextAccueil($textAccueil)->setTextPresentation($textPresentation);
        $manager->persist($content);
        $manager->flush();
        $session->remove('content');
        $session->set('content', $content);
        return $this->redirectToRoute('app_admin_text');
    }
}
