<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MonEspaceController extends AbstractController
{
    #[IsGranted("ROLE_ADMIN")]
    #[Route('/compte', name: 'app_mon_espace')]
    public function indexEntreprise(): Response
    {
        return $this->render('_ADMIN/mon_espace/index.html.twig', [
            'controller_name' => 'MonEspaceController',
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/informations', name: 'app_information')]
    public function information(): Response
    {
        $user = $this->getUser();
        if ($user instanceof Utilisateur) {
            return $this->render('_ADMIN/mon_espace/moncompte.html.twig', [
                'utilisateur' => $user,
            ]);
        }
        return $this->redirectToRoute('app_accueil');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/modifier', name: 'app_modifier_mdp')]
    public function modifierMdp(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $mdp = $request->request->get("mdp");
        if ($user instanceof Utilisateur) {
            $user->setPassword($hasher->hashPassword($user, $mdp));
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_information');
    }
}
