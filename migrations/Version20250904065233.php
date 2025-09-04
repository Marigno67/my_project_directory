<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250904065233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_build (equipement_id INT NOT NULL, build_id INT NOT NULL, INDEX IDX_9B961EEE806F0F5C (equipement_id), INDEX IDX_9B961EEE17C13F8B (build_id), PRIMARY KEY(equipement_id, build_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement_build ADD CONSTRAINT FK_9B961EEE806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_build ADD CONSTRAINT FK_9B961EEE17C13F8B FOREIGN KEY (build_id) REFERENCES build (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_build DROP FOREIGN KEY FK_9B961EEE806F0F5C');
        $this->addSql('ALTER TABLE equipement_build DROP FOREIGN KEY FK_9B961EEE17C13F8B');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_build');
    }
}
