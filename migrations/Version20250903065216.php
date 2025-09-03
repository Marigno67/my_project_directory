<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250903065216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE build (id INT AUTO_INCREMENT NOT NULL, personnage_id INT DEFAULT NULL, build_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_BDA0F2DB5E315342 (personnage_id), INDEX IDX_BDA0F2DB17C13F8B (build_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_de_jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DB5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DB17C13F8B FOREIGN KEY (build_id) REFERENCES mode_de_jeu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DB5E315342');
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DB17C13F8B');
        $this->addSql('DROP TABLE build');
        $this->addSql('DROP TABLE mode_de_jeu');
    }
}
