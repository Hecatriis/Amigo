<?php

namespace App\Controller;

use App\Entity\PartenaireAnnuelle;
use App\Entity\PartenaireEntreprise;
use App\Repository\ContentRepository;
use App\Repository\PartenaireAnnuelleRepository;
use App\Repository\PartenaireEntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireEntrepriseRepository $entrepriseRepository, PartenaireAnnuelleRepository $annuelleRepository,
        Session $session, ContentRepository $contentRepository): Response
    {
        $this->initialisation($session, $contentRepository);
        $partenairesAnuelle = $annuelleRepository->findAll();
        $partenairesEntreprise = $entrepriseRepository->findAll();
        return $this->render('partenaire/index.html.twig', [
            'partenairesAnnuelle' => $partenairesAnuelle,
            'partenairesEntreprise' => $partenairesEntreprise,
            'nbPartenaireAnnuelle' => sizeof($partenairesAnuelle),
            'nbPartenaireEntreprise' => sizeof($partenairesEntreprise)
        ]);
    }

    #[Route('/partenaireEntreprise', name: 'app_partenaire_entreprise')]
    public function indexEntreprise(PartenaireEntrepriseRepository $entrepriseRepository,
        Session $session, ContentRepository $contentRepository): Response
    {
        $this->initialisation($session, $contentRepository);
        $partenairesEntreprise = $entrepriseRepository->findAll();
        return $this->render('partenaire/entreprise.html.twig', [
            'partenairesEntreprise' => $partenairesEntreprise,
            'nbPartenaireEntreprise' => sizeof($partenairesEntreprise)
        ]);
    }

    #[Route('/partenaireAnnuelle', name: 'app_partenaire_annuelle')]
    public function indexAnnuelle(PartenaireAnnuelleRepository $annuelleRepository, Session $session,
      ContentRepository $contentRepository): Response
    {
        $this->initialisation($session, $contentRepository);
        $partenairesAnuelle = $annuelleRepository->findAll();
        return $this->render('partenaire/annuelle.html.twig', [
            'partenairesAnnuelle' => $partenairesAnuelle,
            'nbPartenaireAnnuelle' => sizeof($partenairesAnuelle),
        ]);
    }


    private function initialisation(Session $session, ContentRepository $repository): void
    {
        if ($session->get('content') === null)
            $session->set('content', $repository->findAll()[0]);
    }

}
