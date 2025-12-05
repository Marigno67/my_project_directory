<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204083201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mode_de_jeu ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnage RENAME INDEX idx_a7647084d60322ac TO IDX_6AEA486DD60322AC');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage RENAME INDEX idx_6aea486dd60322ac TO IDX_A7647084D60322AC');
        $this->addSql('ALTER TABLE mode_de_jeu DROP description');
    }
}
