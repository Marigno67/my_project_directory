<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251125155651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bonus_set (id INT AUTO_INCREMENT NOT NULL, set_artefact_id INT NOT NULL, nombre_pieces INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_2978DD74228D2216 (set_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE build (id INT AUTO_INCREMENT NOT NULL, personnage_id INT DEFAULT NULL, mode_de_jeu_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_BDA0F2DB5E315342 (personnage_id), INDEX IDX_BDA0F2DBF09246B2 (mode_de_jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE build_equipement (build_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_4A6F444A17C13F8B (build_id), INDEX IDX_4A6F444A806F0F5C (equipement_id), PRIMARY KEY(build_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, icone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_set (id INT AUTO_INCREMENT NOT NULL, set_artefact_id INT NOT NULL, path VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BEFEF58F228D2216 (set_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_de_jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ombre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, element_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_6AEA486D1F1F2A24 (element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE set_artefact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, sous_titre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_personnage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_personnage_personnage (statistique_personnage_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_C1429DE34AC04AA5 (statistique_personnage_id), INDEX IDX_C1429DE35E315342 (personnage_id), PRIMARY KEY(statistique_personnage_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bonus_set ADD CONSTRAINT FK_2978DD74228D2216 FOREIGN KEY (set_artefact_id) REFERENCES set_artefact (id)');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DB5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DBF09246B2 FOREIGN KEY (mode_de_jeu_id) REFERENCES mode_de_jeu (id)');
        $this->addSql('ALTER TABLE build_equipement ADD CONSTRAINT FK_4A6F444A17C13F8B FOREIGN KEY (build_id) REFERENCES build (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE build_equipement ADD CONSTRAINT FK_4A6F444A806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_set ADD CONSTRAINT FK_BEFEF58F228D2216 FOREIGN KEY (set_artefact_id) REFERENCES set_artefact (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D1F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE34AC04AA5 FOREIGN KEY (statistique_personnage_id) REFERENCES statistique_personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE35E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bonus_set DROP FOREIGN KEY FK_2978DD74228D2216');
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DB5E315342');
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DBF09246B2');
        $this->addSql('ALTER TABLE build_equipement DROP FOREIGN KEY FK_4A6F444A17C13F8B');
        $this->addSql('ALTER TABLE build_equipement DROP FOREIGN KEY FK_4A6F444A806F0F5C');
        $this->addSql('ALTER TABLE image_set DROP FOREIGN KEY FK_BEFEF58F228D2216');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D1F1F2A24');
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE34AC04AA5');
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE35E315342');
        $this->addSql('DROP TABLE bonus_set');
        $this->addSql('DROP TABLE build');
        $this->addSql('DROP TABLE build_equipement');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE image_set');
        $this->addSql('DROP TABLE mode_de_jeu');
        $this->addSql('DROP TABLE ombre');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE set_artefact');
        $this->addSql('DROP TABLE statistique_personnage');
        $this->addSql('DROP TABLE statistique_personnage_personnage');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
