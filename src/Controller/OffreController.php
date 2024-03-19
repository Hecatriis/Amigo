<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Repository\CompetenceRepository;
use App\Repository\OffreRepository;
use App\Repository\PartenaireEntrepriseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/offre', name: 'app_offre')]
    public function index(PartenaireEntrepriseRepository $entrepriseRepository, CompetenceRepository $competenceRepository,
                          OffreRepository $offreRepository, PaginatorInterface $pagination, Request $request, SessionInterface $session): Response
    {
        $session->remove('offresFiltrer');
        $offres = $pagination->paginate(
            $offreRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('offre/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
            'competences' => $competenceRepository->findAll(),
            'offres' => $offres
        ]);
    }

    #[Route('/offre/{id}', name: 'app_offre_view', methods: ['GET'])]
    public function offre_view(Offre $offre): Response
    {
        return $this->render("offre/view.html.twig", [
            'offre' => $offre,
            'competences' => $offre->getCompetences()
        ]);
    }

    #[Route('/offrefiltrer', name: 'app_offre_filtre', methods: ['POST', 'GET'])]
    public function indexFiltrer(Request $request, PartenaireEntrepriseRepository $entrepriseRepository,
                                 CompetenceRepository $competenceRepository, OffreRepository $offreRepository, SessionInterface $session): Response
    {
        $res_offres = $session->get('offresFiltrer');
        if ($request->request->get('submit') === "Filtrer la recherche") {
            $session->remove('offresFiltrer');
            $res_offres = [];
        }

        if ($res_offres === [] || $res_offres === null) {
            $type = $request->request->all()['byTypeOffre'] ?? [];
            $entreprise = $request->request->all()['byEntreprise'] ?? [];
            $ville = $request->request->get('byVille');
            $motCle = $request->request->get('byMotCle');
            $competences = $request->request->all()['byCompetence'] ?? [];

            $res_type = [];
            $res_entreprise = [];
            $res_ville = [];
            $res_motCle = [];
            $res_competence = [];


            if ($type !== [])
                $res_type = $offreRepository->findBy(['typeOffre' => $type]);
            if ($entreprise !== [])
                dump($entreprise);
                $res_entreprise = $offreRepository->findBy(['entreprise' => $entreprise]);
            if ($ville !== [])
                $res_ville = $offreRepository->findBy(['villeOffre' => $ville]);
            if ($motCle !== "")
                $res_motCle = $offreRepository->findOffreByContenu($motCle);
            if ($competences !== []) {
                $res_competence = $this->getOffreByCompetence($competences, $offreRepository, $competenceRepository);
            }

            $res = array_merge($res_type, $res_entreprise, $res_ville, $res_motCle, $res_competence);
            $res_offres = array_unique($res, 0);
            $session->set('offresFiltrer', $res_offres);
        }

        return $this->render('offre/indexFiltrer.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
            'competences' => $competenceRepository->findAll(),
            'offres' => $res_offres,
        ]);

    }

    #[Route('/offrefiltrer/{id}', name: 'app_offre_view_filtre', methods: ['GET'])]
    public function offreFiltrer_view(Offre $offre): Response
    {
        return $this->render("offre/viewFiltre.html.twig", [
            'offre' => $offre,
            'competences' => $offre->getCompetences()
        ]);
    }


    private function getOffreByCompetence(array $competences, OffreRepository $offreRepository,
                                          CompetenceRepository $competenceRepository): array
    {
        $res = [];
        $object = [];
        foreach ($competences as $c) {
            $object[] = $competenceRepository->findOneBy(['id' => $c]);
        }
        $lesOffres = $offreRepository->findAll();
        foreach ($object as $o) {
            foreach ($lesOffres as $offre) {
                if ($offre->getCompetences()->contains($o)) {
                    $res[] = $offre;
                }
            }
        }
        return $res;
    }

}
