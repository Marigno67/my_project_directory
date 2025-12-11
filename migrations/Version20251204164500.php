<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204164500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables ensemble_noyau, noyau et build_noyau pour le système de noyaux';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ensemble_noyau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noyau (id INT AUTO_INCREMENT NOT NULL, ensemble_id INT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_E58A5C70EDB5B765 (ensemble_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE build_noyau (id INT AUTO_INCREMENT NOT NULL, build_id INT NOT NULL, noyau_id INT NOT NULL, priorite INT NOT NULL, INDEX IDX_3F7C8E0717C13F8B (build_id), INDEX IDX_3F7C8E0779E93EE0 (noyau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE noyau ADD CONSTRAINT FK_E58A5C70EDB5B765 FOREIGN KEY (ensemble_id) REFERENCES ensemble_noyau (id)');
        $this->addSql('ALTER TABLE build_noyau ADD CONSTRAINT FK_3F7C8E0717C13F8B FOREIGN KEY (build_id) REFERENCES build (id)');
        $this->addSql('ALTER TABLE build_noyau ADD CONSTRAINT FK_3F7C8E0779E93EE0 FOREIGN KEY (noyau_id) REFERENCES noyau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE noyau DROP FOREIGN KEY FK_E58A5C70EDB5B765');
        $this->addSql('ALTER TABLE build_noyau DROP FOREIGN KEY FK_3F7C8E0717C13F8B');
        $this->addSql('ALTER TABLE build_noyau DROP FOREIGN KEY FK_3F7C8E0779E93EE0');
        $this->addSql('DROP TABLE ensemble_noyau');
        $this->addSql('DROP TABLE noyau');
        $this->addSql('DROP TABLE build_noyau');
    }
}
