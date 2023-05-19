<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519173939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(50) NOT NULL, ville VARCHAR(30) NOT NULL, pays VARCHAR(30) NOT NULL, website VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, telephone INT DEFAULT NULL, logo_entreprise VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_secteur_activite (entreprise_id INT NOT NULL, secteur_activite_id INT NOT NULL, INDEX IDX_743F81E1A4AEAFEA (entreprise_id), INDEX IDX_743F81E15233A7FC (secteur_activite_id), PRIMARY KEY(entreprise_id, secteur_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur_activite (id INT AUTO_INCREMENT NOT NULL, nom_du_secteur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E1A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_secteur_activite ADD CONSTRAINT FK_743F81E15233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E1A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_secteur_activite DROP FOREIGN KEY FK_743F81E15233A7FC');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_secteur_activite');
        $this->addSql('DROP TABLE secteur_activite');
    }
}
