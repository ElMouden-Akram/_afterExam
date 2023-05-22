<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521215923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cycle_etude (id INT AUTO_INCREMENT NOT NULL, fk_etablissement_id INT NOT NULL, titre VARCHAR(50) NOT NULL, discipline VARCHAR(30) NOT NULL, diplome VARCHAR(50) NOT NULL, valider TINYINT(1) NOT NULL, INDEX IDX_B5ED604BA909755F (fk_etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi (id INT AUTO_INCREMENT NOT NULL, fk_entreprise_id INT NOT NULL, titre VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, type VARCHAR(7) NOT NULL, INDEX IDX_74A0B0FAC0E4DA28 (fk_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(50) NOT NULL, ville VARCHAR(30) NOT NULL, pays VARCHAR(30) NOT NULL, website VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, logo_entreprise VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_secteur_activite (entreprise_id INT NOT NULL, secteur_activite_id INT NOT NULL, INDEX IDX_743F81E1A4AEAFEA (entreprise_id), INDEX IDX_743F81E15233A7FC (secteur_activite_id), PRIMARY KEY(entreprise_id, secteur_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissment (id INT AUTO_INCREMENT NOT NULL, nom_etablissement VARCHAR(50) NOT NULL, nom_universite VARCHAR(50) DEFAULT NULL, region VARCHAR(20) NOT NULL, ville VARCHAR(50) NOT NULL, logo_universite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, ajouter_par_id INT NOT NULL, cycle_etude_id INT NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, date_ajout DATE NOT NULL, INDEX IDX_404021BF48E6F9B (ajouter_par_id), INDEX IDX_404021BFA1C852C6 (cycle_etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_emploi (id INT AUTO_INCREMENT NOT NULL, ajouter_par_id INT NOT NULL, fk_emploi_id INT NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, date_ajout DATE NOT NULL, INDEX IDX_132AD0D148E6F9B (ajouter_par_id), INDEX IDX_132AD0D18D58E982 (fk_emploi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_stage (id INT AUTO_INCREMENT NOT NULL, ajouter_par_id INT NOT NULL, fk_emploi_id INT NOT NULL, description LONGTEXT NOT NULL, date_ajout DATE NOT NULL, INDEX IDX_955674F248E6F9B (ajouter_par_id), INDEX IDX_955674F28D58E982 (fk_emploi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur_activite (id INT AUTO_INCREMENT NOT NULL, nom_du_secteur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(40) NOT NULL, last_name VARCHAR(40) NOT NULL, cni VARCHAR(15) DEFAULT NULL, cne VARCHAR(20) DEFAULT NULL, sexe VARCHAR(6) DEFAULT NULL, date_naissance DATE DEFAULT NULL, adresse VARCHAR(60) DEFAULT NULL, telephone VARCHAR(10) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cycle_etude (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, fk_cycle_etude_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_1CF6A9DE5741EEB9 (fk_user_id), INDEX IDX_1CF6A9DED4C6BB2F (fk_cycle_etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_emploi (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, fk_emploi_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_11F2ABC75741EEB9 (fk_user_id), INDEX IDX_11F2ABC78D58E982 (fk_emploi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cycle_etude ADD CONSTRAINT FK_B5ED604BA909755F FOREIGN KEY (fk_etablissement_id) REFERENCES etablissment (id)');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FAC0E4DA28 FOREIGN KEY (fk_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E15233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF48E6F9B FOREIGN KEY (ajouter_par_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA1C852C6 FOREIGN KEY (cycle_etude_id) REFERENCES cycle_etude (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D148E6F9B FOREIGN KEY (ajouter_par_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D18D58E982 FOREIGN KEY (fk_emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE offre_stage ADD CONSTRAINT FK_955674F248E6F9B FOREIGN KEY (ajouter_par_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_stage ADD CONSTRAINT FK_955674F28D58E982 FOREIGN KEY (fk_emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE user_cycle_etude ADD CONSTRAINT FK_1CF6A9DE5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_cycle_etude ADD CONSTRAINT FK_1CF6A9DED4C6BB2F FOREIGN KEY (fk_cycle_etude_id) REFERENCES cycle_etude (id)');
        $this->addSql('ALTER TABLE user_emploi ADD CONSTRAINT FK_11F2ABC75741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_emploi ADD CONSTRAINT FK_11F2ABC78D58E982 FOREIGN KEY (fk_emploi_id) REFERENCES emploi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle_etude DROP FOREIGN KEY FK_B5ED604BA909755F');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FAC0E4DA28');
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E1A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E15233A7FC');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF48E6F9B');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA1C852C6');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D148E6F9B');
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D18D58E982');
        $this->addSql('ALTER TABLE offre_stage DROP FOREIGN KEY FK_955674F248E6F9B');
        $this->addSql('ALTER TABLE offre_stage DROP FOREIGN KEY FK_955674F28D58E982');
        $this->addSql('ALTER TABLE user_cycle_etude DROP FOREIGN KEY FK_1CF6A9DE5741EEB9');
        $this->addSql('ALTER TABLE user_cycle_etude DROP FOREIGN KEY FK_1CF6A9DED4C6BB2F');
        $this->addSql('ALTER TABLE user_emploi DROP FOREIGN KEY FK_11F2ABC75741EEB9');
        $this->addSql('ALTER TABLE user_emploi DROP FOREIGN KEY FK_11F2ABC78D58E982');
        $this->addSql('DROP TABLE cycle_etude');
        $this->addSql('DROP TABLE emploi');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_secteur_activite');
        $this->addSql('DROP TABLE etablissment');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE offre_emploi');
        $this->addSql('DROP TABLE offre_stage');
        $this->addSql('DROP TABLE secteur_activite');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_cycle_etude');
        $this->addSql('DROP TABLE user_emploi');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
