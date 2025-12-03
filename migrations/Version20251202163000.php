<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Ajout de la table Role et de la relation avec Personnage
 */
final class Version20251202163000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la table role et de la colonne role_id dans personnage';
    }

    public function up(Schema $schema): void
    {
        // Création de la table role
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, icone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Ajout de la colonne role_id dans personnage
        $this->addSql('ALTER TABLE personnage ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_A7647084D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_A7647084D60322AC ON personnage (role_id)');
    }

    public function down(Schema $schema): void
    {
        // Suppression de la relation
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_A7647084D60322AC');
        $this->addSql('DROP INDEX IDX_A7647084D60322AC ON personnage');
        $this->addSql('ALTER TABLE personnage DROP role_id');

        // Suppression de la table role
        $this->addSql('DROP TABLE role');
    }
}
