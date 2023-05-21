<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521134610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emploi (id INT AUTO_INCREMENT NOT NULL, fk_entreprise_id INT NOT NULL, titre VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, INDEX IDX_74A0B0FAC0E4DA28 (fk_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FAC0E4DA28 FOREIGN KEY (fk_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE offre_emploi ADD CONSTRAINT FK_132AD0D1EC013E12 FOREIGN KEY (emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE user_emploi ADD CONSTRAINT FK_11F2ABC78D58E982 FOREIGN KEY (fk_emploi_id) REFERENCES emploi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploi DROP FOREIGN KEY FK_132AD0D1EC013E12');
        $this->addSql('ALTER TABLE user_emploi DROP FOREIGN KEY FK_11F2ABC78D58E982');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FAC0E4DA28');
        $this->addSql('DROP TABLE emploi');
    }
}
