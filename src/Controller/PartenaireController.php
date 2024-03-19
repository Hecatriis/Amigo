<?php

namespace App\Controller;

use App\Entity\PartenaireAnnuelle;
use App\Entity\PartenaireEntreprise;
use App\Repository\PartenaireAnnuelleRepository;
use App\Repository\PartenaireEntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire', name: 'app_partenaire')]
    public function index(PartenaireEntrepriseRepository $entrepriseRepository, PartenaireAnnuelleRepository $annuelleRepository): Response
    {
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
    public function indexEntreprise(PartenaireEntrepriseRepository $entrepriseRepository): Response
    {
        $partenairesEntreprise = $entrepriseRepository->findAll();
        return $this->render('partenaire/entreprise.html.twig', [
            'partenairesEntreprise' => $partenairesEntreprise,
            'nbPartenaireEntreprise' => sizeof($partenairesEntreprise)
        ]);
    }

    #[Route('/partenaireAnnuelle', name: 'app_partenaire_annuelle')]
    public function indexAnnuelle(PartenaireAnnuelleRepository $annuelleRepository): Response
    {
        $partenairesAnuelle = $annuelleRepository->findAll();
        return $this->render('partenaire/annuelle.html.twig', [
            'partenairesAnnuelle' => $partenairesAnuelle,
            'nbPartenaireAnnuelle' => sizeof($partenairesAnuelle),
        ]);
    }


}
