<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519191437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_stage ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_stage ADD CONSTRAINT FK_955674F2A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_955674F2A4AEAFEA ON offre_stage (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_stage DROP FOREIGN KEY FK_955674F2A4AEAFEA');
        $this->addSql('DROP INDEX IDX_955674F2A4AEAFEA ON offre_stage');
        $this->addSql('ALTER TABLE offre_stage DROP entreprise_id');
    }
}
