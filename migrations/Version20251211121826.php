<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251211121826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Drop the build_noyau table
        $this->addSql('ALTER TABLE build_noyau DROP FOREIGN KEY FK_3F7C8E0717C13F8B');
        $this->addSql('ALTER TABLE build_noyau DROP FOREIGN KEY FK_3F7C8E0779E93EE0');
        $this->addSql('DROP TABLE build_noyau');

        // Create the personnage_noyau table
        $this->addSql('CREATE TABLE personnage_noyau (id INT AUTO_INCREMENT NOT NULL, personnage_id INT NOT NULL, noyau_id INT NOT NULL, priorite INT NOT NULL, INDEX IDX_2E9F59D45E315342 (personnage_id), INDEX IDX_2E9F59D490231F94 (noyau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnage_noyau ADD CONSTRAINT FK_2E9F59D45E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE personnage_noyau ADD CONSTRAINT FK_2E9F59D490231F94 FOREIGN KEY (noyau_id) REFERENCES noyau (id)');

        // Rename index
        $this->addSql('ALTER TABLE noyau RENAME INDEX idx_e58a5c70edb5b765 TO IDX_84CC55EEB268ECB1');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // Drop personnage_noyau table
        $this->addSql('ALTER TABLE personnage_noyau DROP FOREIGN KEY FK_2E9F59D45E315342');
        $this->addSql('ALTER TABLE personnage_noyau DROP FOREIGN KEY FK_2E9F59D490231F94');
        $this->addSql('DROP TABLE personnage_noyau');

        // Recreate build_noyau table
        $this->addSql('CREATE TABLE build_noyau (id INT AUTO_INCREMENT NOT NULL, build_id INT NOT NULL, noyau_id INT NOT NULL, priorite INT NOT NULL, INDEX IDX_3F7C8E0717C13F8B (build_id), INDEX IDX_3F7C8E0779E93EE0 (noyau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE build_noyau ADD CONSTRAINT FK_3F7C8E0717C13F8B FOREIGN KEY (build_id) REFERENCES build (id)');
        $this->addSql('ALTER TABLE build_noyau ADD CONSTRAINT FK_3F7C8E0779E93EE0 FOREIGN KEY (noyau_id) REFERENCES noyau (id)');

        // Rename index
        $this->addSql('ALTER TABLE noyau RENAME INDEX idx_84cc55eeb268ecb1 TO IDX_E58A5C70EDB5B765');
    }
}
