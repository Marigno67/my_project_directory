<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250923081426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistique_personnage_personnage (statistique_personnage_id INT NOT NULL, personnage_id INT NOT NULL, INDEX IDX_C1429DE34AC04AA5 (statistique_personnage_id), INDEX IDX_C1429DE35E315342 (personnage_id), PRIMARY KEY(statistique_personnage_id, personnage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE34AC04AA5 FOREIGN KEY (statistique_personnage_id) REFERENCES statistique_personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistique_personnage_personnage ADD CONSTRAINT FK_C1429DE35E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistique_personnage DROP FOREIGN KEY FK_8E1799095E315342');
        $this->addSql('DROP INDEX IDX_8E1799095E315342 ON statistique_personnage');
        $this->addSql('ALTER TABLE statistique_personnage DROP personnage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE34AC04AA5');
        $this->addSql('ALTER TABLE statistique_personnage_personnage DROP FOREIGN KEY FK_C1429DE35E315342');
        $this->addSql('DROP TABLE statistique_personnage_personnage');
        $this->addSql('ALTER TABLE statistique_personnage ADD personnage_id INT NOT NULL');
        $this->addSql('ALTER TABLE statistique_personnage ADD CONSTRAINT FK_8E1799095E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8E1799095E315342 ON statistique_personnage (personnage_id)');
    }
}
