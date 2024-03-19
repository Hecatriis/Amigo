<?php

namespace App\DataFixtures;

use App\Entity\Bureau;
use App\Entity\Utilisateur;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class BureauFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        $this->makeBureau($manager,$this->hasher);
        $manager->flush();
    }

    private function makeBureau(ObjectManager $manager, UserPasswordHasherInterface $hasher): void
    {
        $bureau = new Bureau();
        $bureau
            ->setNom("Lanchard")
            ->setPrenom("Léo")
            ->setPole("Évènementiel")
            ->setRole("CM")
            ->setDateDebut(new DateTime("2024-01-25"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Autréaux")
            ->setPrenom("Denis")
            ->setPole("Évènementiel")
            ->setRole("CM")
            ->setDateDebut(new DateTime("2024-01-25"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Sevot")
            ->setPrenom("Maxime")
            ->setPole("ENTA")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2024-01-25"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Dubourjal")
            ->setPrenom("Tom")
            ->setPole("Présidence")
            ->setRole("Vice-Président")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Dufour")
            ->setPrenom("Léonie")
            ->setPole("Communication")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Dos Santos")
            ->setPrenom("Nolwenn")
            ->setPole("Trésorerie")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Guérin")
            ->setPrenom("Marilou")
            ->setPole("Présidence")
            ->setRole("Présidente")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Durelle")
            ->setPrenom("Randy")
            ->setPole("Évènementiel")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Ottmann")
            ->setPrenom("Emma")
            ->setPole("Secrétariat")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Baron-Crus")
            ->setPrenom("Thomas")
            ->setPole("Partenariat")
            ->setRole("CM")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $bureau = new Bureau();
        $bureau
            ->setNom("Legeay")
            ->setPrenom("Corentin")
            ->setPole("Partenariat")
            ->setRole("VP")
            ->setDateDebut(new DateTime("2023-09-01"))
            ->setNameFile('default.png')
        ;
        $manager->persist($bureau);

        $user = new Utilisateur();
        $user->setEmail("admin@admin.fr")
            ->setPassword($this->hasher->hashPassword($user, "admin"))
            ->setRoles(["ROLE_ADMIN"])
        ;
        $manager->persist($user);

        $manager->flush();
    }
}
