<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250923141518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_set (id INT AUTO_INCREMENT NOT NULL, set_artefact_id INT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_BEFEF58F228D2216 (set_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_set ADD CONSTRAINT FK_BEFEF58F228D2216 FOREIGN KEY (set_artefact_id) REFERENCES set_artefact (id)');
        $this->addSql('ALTER TABLE set_artefact DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_set DROP FOREIGN KEY FK_BEFEF58F228D2216');
        $this->addSql('DROP TABLE image_set');
        $this->addSql('ALTER TABLE set_artefact ADD image VARCHAR(255) DEFAULT NULL');
    }
}
