<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $content = new Content();
        $content
            ->setTelephone("0786171082")
            ->setMailAmigo("contact.amigoorleans@gmail.com")
            ->setLogoName("logo.png")
            ->setIconeSiteName("logo.ico")
            ->setImageAccueilName("accueil.png")
            ->setTextAccueil("L'Amigo est une association étudiante, à but non lucrative, située à la Faculté d'Orléans. Nous sommes affiliés au cursus MIAGE (Méthodes Informatiques Appliquées à la Gestion des Entreprises). Si vous souhaitez adhérer à notre association, vous pouvez vous rendre sur notre page HelloAsso en cliquant ci-dessous :) ")
            ->setTextPresentation($faker->paragraphs(8, true))
        ;
        $manager->persist($content);
        $manager->flush();
    }
}
