<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519161531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_cycle_etude (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, fk_cycle_etude_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_1CF6A9DE5741EEB9 (fk_user_id), INDEX IDX_1CF6A9DED4C6BB2F (fk_cycle_etude_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_cycle_etude ADD CONSTRAINT FK_1CF6A9DE5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_cycle_etude ADD CONSTRAINT FK_1CF6A9DED4C6BB2F FOREIGN KEY (fk_cycle_etude_id) REFERENCES cycle_etude (id)');
        $this->addSql('ALTER TABLE cycle_etude CHANGE valider valider TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cycle_etude DROP FOREIGN KEY FK_1CF6A9DE5741EEB9');
        $this->addSql('ALTER TABLE user_cycle_etude DROP FOREIGN KEY FK_1CF6A9DED4C6BB2F');
        $this->addSql('DROP TABLE user_cycle_etude');
        $this->addSql('ALTER TABLE cycle_etude CHANGE valider valider TINYINT(1) DEFAULT 1 NOT NULL');
    }
}
