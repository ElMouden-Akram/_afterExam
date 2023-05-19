<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519211917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, ajouter_par_id INT NOT NULL, cycle_etude_id INT NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, date_ajout DATE NOT NULL, INDEX IDX_404021BF48E6F9B (ajouter_par_id), INDEX IDX_404021BFA1C852C6 (cycle_etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF48E6F9B FOREIGN KEY (ajouter_par_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA1C852C6 FOREIGN KEY (cycle_etude_id) REFERENCES cycle_etude (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF48E6F9B');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA1C852C6');
        $this->addSql('DROP TABLE formation');
    }
}
