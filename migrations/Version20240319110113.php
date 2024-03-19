<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319110113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bureau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE challenge_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE competence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE content_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partenaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bureau (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pole VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, name_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE challenge (id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, lieu VARCHAR(255) NOT NULL, date DATE NOT NULL, name_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE competence (id INT NOT NULL, libelle_competence VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE content (id INT NOT NULL, text_accueil TEXT NOT NULL, text_presentation TEXT NOT NULL, mail_amigo VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, logo_name VARCHAR(255) DEFAULT NULL, image_accueil_name VARCHAR(255) DEFAULT NULL, icone_site_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE offre (id INT NOT NULL, entreprise_id INT NOT NULL, titre_offre TEXT NOT NULL, ville_offre VARCHAR(255) NOT NULL, code_postal_offre VARCHAR(255) NOT NULL, type_offre VARCHAR(255) NOT NULL, resume_offre TEXT NOT NULL, contenu_offre TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF86866FA4AEAFEA ON offre (entreprise_id)');
        $this->addSql('CREATE TABLE offre_competence (offre_id INT NOT NULL, competence_id INT NOT NULL, PRIMARY KEY(offre_id, competence_id))');
        $this->addSql('CREATE INDEX IDX_B98A0F5A4CC8505A ON offre_competence (offre_id)');
        $this->addSql('CREATE INDEX IDX_B98A0F5A15761DAB ON offre_competence (competence_id)');
        $this->addSql('CREATE TABLE partenaire (id INT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, description TEXT NOT NULL, ville VARCHAR(255) NOT NULL, site_web TEXT NOT NULL, name_file VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE partenaire_annuelle (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE partenaire_entreprise (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES partenaire_entreprise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_competence ADD CONSTRAINT FK_B98A0F5A4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_competence ADD CONSTRAINT FK_B98A0F5A15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partenaire_annuelle ADD CONSTRAINT FK_2B7BE1BF396750 FOREIGN KEY (id) REFERENCES partenaire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partenaire_entreprise ADD CONSTRAINT FK_C55AD773BF396750 FOREIGN KEY (id) REFERENCES partenaire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bureau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE challenge_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE competence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE content_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partenaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('ALTER TABLE offre DROP CONSTRAINT FK_AF86866FA4AEAFEA');
        $this->addSql('ALTER TABLE offre_competence DROP CONSTRAINT FK_B98A0F5A4CC8505A');
        $this->addSql('ALTER TABLE offre_competence DROP CONSTRAINT FK_B98A0F5A15761DAB');
        $this->addSql('ALTER TABLE partenaire_annuelle DROP CONSTRAINT FK_2B7BE1BF396750');
        $this->addSql('ALTER TABLE partenaire_entreprise DROP CONSTRAINT FK_C55AD773BF396750');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_competence');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE partenaire_annuelle');
        $this->addSql('DROP TABLE partenaire_entreprise');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
