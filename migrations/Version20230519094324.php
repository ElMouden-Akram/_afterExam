<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519094324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle_etude ADD fk_etablissement_id INT NOT NULL');
        $this->addSql('ALTER TABLE cycle_etude ADD CONSTRAINT FK_B5ED604BA909755F FOREIGN KEY (fk_etablissement_id) REFERENCES etablissment (id)');
        $this->addSql('CREATE INDEX IDX_B5ED604BA909755F ON cycle_etude (fk_etablissement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle_etude DROP FOREIGN KEY FK_B5ED604BA909755F');
        $this->addSql('DROP INDEX IDX_B5ED604BA909755F ON cycle_etude');
        $this->addSql('ALTER TABLE cycle_etude DROP fk_etablissement_id');
    }
}
