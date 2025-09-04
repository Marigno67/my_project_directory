<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250904081131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE build_equipement (build_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_4A6F444A17C13F8B (build_id), INDEX IDX_4A6F444A806F0F5C (equipement_id), PRIMARY KEY(build_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE build_equipement ADD CONSTRAINT FK_4A6F444A17C13F8B FOREIGN KEY (build_id) REFERENCES build (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE build_equipement ADD CONSTRAINT FK_4A6F444A806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE build_equipement DROP FOREIGN KEY FK_4A6F444A17C13F8B');
        $this->addSql('ALTER TABLE build_equipement DROP FOREIGN KEY FK_4A6F444A806F0F5C');
        $this->addSql('DROP TABLE build_equipement');
    }
}
