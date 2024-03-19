<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\Offre;
use App\Entity\PartenaireAnnuelle;
use App\Entity\PartenaireEntreprise;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Random\RandomException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class EntrepriseFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $this->makeEntreprisePartenaire($manager);
        $this->makeEntrepriseAnnuelle($manager);

        $manager->flush();
    }

    /**
     * @throws RandomException
     */
    private function makeEntreprisePartenaire(ObjectManager $manager): void
    {
        $competences = $this->makeCompetence($manager);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Sopra Steria")
            ->setAdresse("10 Rue Emile Zola")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.soprasteria.com/fr")
            ->setNameFile("Sopra.png")
            ->setDescription("Les technologies donnent accès à un nombre de possibilités infinies. Ce flux perpétuel d’innovations fascine autant qu’il questionne sur le sens de cette course effrénée à la nouveauté et au changement. Les réponses ne sont ni simples, ni évidentes, et surtout, elles sont multiples. Chez Sopra Steria, notre mission est de guider nos clients, partenaires et collaborateurs vers des choix audacieux pour construire un avenir positif en mettant le digital au service de l’humain.")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Randstad")
            ->setAdresse("3 Rue Pierre-Gilles de Gennes")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.randstad.fr/")
            ->setNameFile("Randstad.png")
            ->setDescription("Randstad opère dans une quarantaine de pays. Chaque jour, plus de 500 000 intérimaires travaillent dans des entreprises par l’intermédiaire de Randstad. Dans le monde, Randstad dispose de plus de 4 500 agences. ")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Cat-Amania")
            ->setAdresse("33 Boulevard Rocheplatte")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.cat-amania.com/")
            ->setNameFile("Cat-Amania.png")
            ->setDescription("Cat-Amania est une société de conseil et de services numériques créée pour réaliser la transformation digitale de ses clients. Elle se fonde sur ses expertises métier, technique et méthodologique pour accompagner ses clients dans leurs grands projets de transformation. at-Amania définit et participe à l’évolution du système d’information de ses clients dans les domaines de la banque, de l’assurance, de la grande distribution et de l’industrie. Avec plus de 20 ans d’expérience, Cat-Amania est en mesure de répondre aux besoins de ses clients avec des offres adaptables sur les thématiques d’Architecture, de Conseil, d’Etude, de Développement, de Test, de Paramétrage et de Pilotage.")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Atos")
            ->setAdresse("649 Rue du Rosier")
            ->setCodePostal("45160")
            ->setVille("Olivet")
            ->setSiteWeb("https://atos.net/fr/")
            ->setNameFile("Atos.png")
            ->setDescription("Les technologies repoussent sans cesse les limites des champs d’actions. Nos clients peuvent compter sur nous et se laisser guider vers une transformation digitale réussie. Chez Atos, nous accomplissons ce parcours en nous efforçant de rester un partenaire de confiance livrant l’autonomisation digitale à nos clients. Nos mots clés sont la transformation digitale, l’innovation et la création de valeur, autant pour notre propre entreprise que pour nos clients. Nous nous sommes positionnés en tant que partenaire de confiance pour la transformation digitale de nos clients en utilisant les ressources, l’ampleur et le savoir-faire dont nos clients ont besoin.")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Acensi")
            ->setAdresse("4 Rue de Patay")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.acensi.fr/page/accueil/fr_fr")
            ->setNameFile("Acensi.png")
            ->setDescription("Positionné depuis sa création entre le cabinet de conseil généraliste et l’ESN spécialisée, le groupe ACENSI accompagne depuis 20 ans plus de 90 clients dans la gestion de leurs projets IT. Nous intervenons en conseil, en développement d'applications et en maintien des infrastructures informatiques dans des domaines sensibles tout en préservant l'efficience de la gestion des clients et des revenus. Rejoindre ACENSI, c’est évoluer dans un Groupe international en forte croissance, guidé par l’excellence et l’expertise de ses consultants.")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Apside")
            ->setAdresse("6 bis Avenue Jean Zay")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.apside.com/fr/")
            ->setNameFile("Apside.png")
            ->setDescription("Apside aspire à réinventer le modèle de l’ESN en alliant performance sociétale et technologique. A la fois groupe international et partenaire de proximité, il s’appuie sur la richesse de ses 3000 collaborateurs et experts répartis dans 28 agences.")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Neosoft")
            ->setAdresse("1 Place Rivierre-Casalis Immeuble Citévolia")
            ->setCodePostal("45400")
            ->setVille("Fleury-les-Aubrais")
            ->setSiteWeb("https://www.neosoft.fr/")
            ->setNameFile("Neosoft.png")
            ->setDescription("Créé à Rennes en 2005, Néosoft est un groupe indépendant de conseil en transformation digitale de près de 1800 collaborateurs réunis en communautés d’experts : Conseil & Agilité, Cybersécurité, Data, DevOps, Infrastructures & Cloud et Software Engineering. La combinaison de ces expertises complémentaires nous permet d’accompagner nos clients à 360° sur leurs projets de transformation digitale, sur nos 6 marchés cibles : Banque & Finance, Télécom & Média, Assurance & Protection sociale, Retail, Energie et Secteur Public. ")
        ;
        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

        $entreprisePartenaire = new PartenaireEntreprise;
        $entreprisePartenaire->setNomEntreprise("Euro-Information Développement")
            ->setAdresse("103 bis Rue du Faubourg Madelaine")
            ->setCodePostal("45000")
            ->setVille("Orléans")
            ->setSiteWeb("https://www.e-i.com/fr/index.html")
            ->setNameFile("EID.png")
            ->setDescription("Euro-Information est la Filiale Technologique du Crédit Mutuel* depuis quatre décennies et gère notamment le Système d’Information (SI) de 16 Groupes de Crédit Mutuel, de toutes les Banques CIC et de l’ensemble des filiales exerçant des métiers financiers, technologiques, d’assurances, d’immobilier, de crédits à la consommation, de banque privée et de financement. L’entreprise partage les valeurs du Crédit Mutuel : innovation, proximité et solidarité en gardant toujours la technologie au service de l’humain. ")
        ;

        $this->makeOffre($manager, $entreprisePartenaire, competences: $competences);
        $manager->persist($entreprisePartenaire);

    }

    private function makeEntrepriseAnnuelle(ObjectManager $manager): void
    {
        $partenaire = new PartenaireAnnuelle();
        $partenaire->setNomEntreprise("L'art en burger")
            ->setVille("Orléans")
            ->setCodePostal("45000")
            ->setAdresse("5 Rue des Minimes")
            ->setSiteWeb("https://www.lartenburger.fr/")
            ->setNameFile("burger.jpg")
            ->setDescription("Amateur de gastronomie à la française et fin gourmet, le chef de L’art en burger, Damien Rivier, a étudié à l’école hôtelière de Montargis, avant de travailler dans divers établissements sur Paris et sur Orléans, ce qui lui a permis d’acquérir une connaissance solide de la restauration. C’est fort de ces expériences, et la tête pleine d’idées et d’envies qu’il a souhaité se lancer dans le domaine très convoité du burger à la française et monter son propre concept avec L’art en burger.")
        ;
        $manager->persist($partenaire);

        $partenaire = new PartenaireAnnuelle();
        $partenaire->setNomEntreprise("L'épi d'or")
            ->setVille("Orléans")
            ->setCodePostal("45000")
            ->setAdresse("59 Rue Maurice Dubois")
            ->setSiteWeb("https://boulangerielepidor.fr/")
            ->setNameFile("epi.jpg")
            ->setDescription("C'est après un parcours atypique que Xavier devient votre boulanger. Depuis tout petit le nez dans la pâtisserie, c'est finalement l'école hôtelière de Blois qui accueille Xavier pour ces premiers pas dans les métiers de l'alimentaire. BEP en poche il s'exil à Souillac pour trouver sa voie de pâtissier, mais il ne s'arrête pas là. Toujours à Souillac il se spécialise comme ouvrier traiteur. Grâce à toutes ces expériences, la vie active le reçois premièrement sous les drapeaux Français comme volontaire à l'aide technique dans les terres australes. Après cette belle expérience c'est en Russie qu'il pose ses valises pour 2 ans et demi d'où il reviendra avec sa matriochka. De là il repart sur les bancs de l'école pour préparer son diplôme de boulanger. Après quelques années d'expérience, il joint ses compétences à son épouse Miroslava pour racheter L'Épi d'or à Orléans.")
        ;
        $manager->persist($partenaire);

        $partenaire = new PartenaireAnnuelle();
        $partenaire->setNomEntreprise("Les ateliers du Faubourg")
            ->setVille("Orléans")
            ->setCodePostal("45000")
            ->setAdresse("95 Rue du Faubourg Bannier")
            ->setSiteWeb("https://www.facebook.com/LesAteliersduFaubourgtatouage/")
            ->setNameFile("tatoo.jpg")
            ->setDescription("Tatoueur situé à Orléans centre")
        ;
        $manager->persist($partenaire);

        $partenaire = new PartenaireAnnuelle();
        $partenaire->setNomEntreprise("Phood")
            ->setVille("Orléans")
            ->setCodePostal("45000")
            ->setAdresse("14-16 Place du Châtelet")
            ->setSiteWeb("https://phood.fr/nos-canteens/orleans/")
            ->setNameFile("Phood.jpg")
            ->setDescription("Nos Plats, Notre Fierté – Des herbes fraîches, des légumes croquants et des produits bruts demandent une vraie attention de la part de nos équipes et une vraie motivation pour s’assurer d’un travail bien fait. Etre fier de chaque plat sortant de nos cuisines est notre objectif quotidien. C’est exactement ce que nous promettons à nos clients.")
        ;
        $manager->persist($partenaire);
    }

    private function makeCompetence(ObjectManager $manager): ArrayCollection
    {
        $competences = new ArrayCollection();
        $competence = new Competence();
        $competence
            ->setLibelleCompetence("Oracle");
        $competences->add($competence);
        $manager->persist($competence);

        $competence = new Competence();
        $competence
            ->setLibelleCompetence("Java");
        $competences->add($competence);
        $manager->persist($competence);

        $competence = new Competence();
        $competence
            ->setLibelleCompetence("Symfony");
        $competences->add($competence);
        $manager->persist($competence);

        $competence = new Competence();
        $competence
            ->setLibelleCompetence("Cobol");
        $competences->add($competence);
        $manager->persist($competence);

        $competence = new Competence();
        $competence
            ->setLibelleCompetence("Merise");
        $competences->add($competence);
        $manager->persist($competence);

        $competence = new Competence();
        $competence
            ->setLibelleCompetence("UML");
        $competences->add($competence);
        $manager->persist($competence);

        return $competences;
    }

    /**
     * @throws RandomException
     */
    private function makeOffre(ObjectManager $manager, PartenaireEntreprise $entreprisePartenaire,
                               ArrayCollection $competences): void
    {
        $faker = Factory::create('fr_FR');
        $type = ['Stage', 'Alternance', 'CDI'];
        for ($i = 0 ; $i <= 10; $i++) {
            $typeOffre = $type[random_int(0,2)];
            $offre = new Offre();
            $nb = random_int(0, $competences->count()-1);
            for ($j = 0 ; $j <= $nb / 2 ; $j ++) {
                $offre->addCompetence($competences->get(random_int(0, $competences->count()-1)));
            }
            $offre
                ->setEntreprise($entreprisePartenaire)
                ->setContenuOffre($faker->paragraphs(10, true))
                ->setResumeOffre($faker->paragraphs(10, true))
                ->setCodePostalOffre("" . random_int(45000, 75000))
                ->setVilleOffre($faker->city)
            ;

            switch ($typeOffre) {
                case "Stage":
                    $offre->setTitreOffre("Stage fin de cycle l3")->setTypeOffre($typeOffre);
                    break;
                case "Alternance":
                    $offre->setTitreOffre("Alternance pour master MIAGE")->setTypeOffre($typeOffre);
                    break;
                case "CDI":
                    $offre->setTitreOffre("CDI suite au master MIAGE")->setTypeOffre($typeOffre);
                    break;
            }

            $manager->persist($offre);
        }
    }
}
