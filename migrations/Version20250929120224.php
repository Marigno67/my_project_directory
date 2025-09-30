<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929120224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bonus_set (id INT AUTO_INCREMENT NOT NULL, set_artefact_id INT NOT NULL, nombre_pieces INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_2978DD74228D2216 (set_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, icone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_set (id INT AUTO_INCREMENT NOT NULL, set_artefact_id INT NOT NULL, path VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BEFEF58F228D2216 (set_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ombre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE set_artefact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, sous_titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_personnage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_personnage_personnage (statistique_personnage_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_C1429DE34AC04AA5 (statistique_personnage_id), INDEX IDX_C1429DE35E315342 (personnage_id), PRIMARY KEY(statistique_personnage_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bonus_set ADD CONSTRAINT FK_2978DD74228D2216 FOREIGN KEY (set_artefact_id) REFERENCES set_artefact (id)');
        $this->addSql('ALTER TABLE image_set ADD CONSTRAINT FK_BEFEF58F228D2216 FOREIGN KEY (set_artefact_id) REFERENCES set_artefact (id)');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE34AC04AA5 FOREIGN KEY (statistique_personnage_id) REFERENCES statistique_personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE35E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_build DROP FOREIGN KEY FK_9B961EEE17C13F8B');
        $this->addSql('ALTER TABLE equipement_build DROP FOREIGN KEY FK_9B961EEE806F0F5C');
        $this->addSql('DROP TABLE equipement_build');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
        $this->addSql('CREATE INDEX IDX_6AEA486D1F1F2A24 ON personnage (element_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D1F1F2A24');
        $this->addSql('CREATE TABLE equipement_build (equipement_id INT NOT NULL, build_id INT NOT NULL, INDEX IDX_9B961EEE17C13F8B (build_id), INDEX IDX_9B961EEE806F0F5C (equipement_id), PRIMARY KEY(equipement_id, build_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipement_build ADD CONSTRAINT FK_9B961EEE17C13F8B FOREIGN KEY (build_id) REFERENCES build (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_build ADD CONSTRAINT FK_9B961EEE806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bonus_set DROP FOREIGN KEY FK_2978DD74228D2216');
        $this->addSql('ALTER TABLE image_set DROP FOREIGN KEY FK_BEFEF58F228D2216');
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE34AC04AA5');
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE35E315342');
        $this->addSql('DROP TABLE bonus_set');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE image_set');
        $this->addSql('DROP TABLE ombre');
        $this->addSql('DROP TABLE set_artefact');
        $this->addSql('DROP TABLE statistique_personnage');
        $this->addSql('DROP TABLE statistique_personnage_personnage');
        $this->addSql('DROP INDEX IDX_6AEA486D1F1F2A24 ON personnage');
    }
}
