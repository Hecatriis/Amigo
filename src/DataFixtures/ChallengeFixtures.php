<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChallengeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $challenge = new Challenge();
        $challenge
            ->setNameFile("blind-test.png")
            ->setDescription($faker->paragraphs(4, true))
            ->setDate(\DateTimeImmutable::createFromFormat("Y-m-d", "2023-11-23"))
            ->setLieu("Orléans - Bâtiment 3IA")
            ->setTitre("Challenge MIAGE X Entreprises - Blind Test")
        ;
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge
            ->setNameFile("bowling.png")
            ->setDescription($faker->paragraphs(4, true))
            ->setDate(\DateTimeImmutable::createFromFormat("Y-m-d", "2024-01-18"))
            ->setLieu("Olivet - Bowling")
            ->setTitre("Challenge MIAGE X Entreprises - Bowling")
        ;
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge
            ->setNameFile("casino.png")
            ->setDescription($faker->paragraphs(4, true))
            ->setDate(\DateTimeImmutable::createFromFormat("Y-m-d", "2023-10-12"))
            ->setLieu("Orléans - Bâtiment 3IA")
            ->setTitre("Challenge MIAGE X Entreprises - Casino")
        ;
        $manager->persist($challenge);

        $challenge = new Challenge();
        $challenge
            ->setNameFile("escape-game.png")
            ->setDescription($faker->paragraphs(4, true))
            ->setDate(\DateTimeImmutable::createFromFormat("Y-m-d", "2024-02-15"))
            ->setLieu("Orléans - Bâtiment 3IA")
            ->setTitre("Challenge MIAGE X Entreprises - Escape Game")
        ;
        $manager->persist($challenge);

        $manager->flush();
    }
}
