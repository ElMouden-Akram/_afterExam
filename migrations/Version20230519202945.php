<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519202945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_emploi (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, fk_emploi_id INT NOT NULL, INDEX IDX_11F2ABC75741EEB9 (fk_user_id), INDEX IDX_11F2ABC78D58E982 (fk_emploi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_emploi ADD CONSTRAINT FK_11F2ABC75741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_emploi ADD CONSTRAINT FK_11F2ABC78D58E982 FOREIGN KEY (fk_emploi_id) REFERENCES emploi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_emploi DROP FOREIGN KEY FK_11F2ABC75741EEB9');
        $this->addSql('ALTER TABLE user_emploi DROP FOREIGN KEY FK_11F2ABC78D58E982');
        $this->addSql('DROP TABLE user_emploi');
    }
}
