<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230518191354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_stage ADD ajouter_par_id INT NOT NULL, ADD date_ajout DATE NOT NULL');
        $this->addSql('ALTER TABLE offre_stage ADD CONSTRAINT FK_955674F248E6F9B FOREIGN KEY (ajouter_par_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_955674F248E6F9B ON offre_stage (ajouter_par_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_stage DROP FOREIGN KEY FK_955674F248E6F9B');
        $this->addSql('DROP INDEX IDX_955674F248E6F9B ON offre_stage');
        $this->addSql('ALTER TABLE offre_stage DROP ajouter_par_id, DROP date_ajout');
    }
}
