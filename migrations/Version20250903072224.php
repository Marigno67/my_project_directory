<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250903072224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DB17C13F8B');
        $this->addSql('DROP INDEX IDX_BDA0F2DB17C13F8B ON build');
        $this->addSql('ALTER TABLE build CHANGE build_id mode_de_jeu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DBF09246B2 FOREIGN KEY (mode_de_jeu_id) REFERENCES mode_de_jeu (id)');
        $this->addSql('CREATE INDEX IDX_BDA0F2DBF09246B2 ON build (mode_de_jeu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE build DROP FOREIGN KEY FK_BDA0F2DBF09246B2');
        $this->addSql('DROP INDEX IDX_BDA0F2DBF09246B2 ON build');
        $this->addSql('ALTER TABLE build CHANGE mode_de_jeu_id build_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DB17C13F8B FOREIGN KEY (build_id) REFERENCES mode_de_jeu (id)');
        $this->addSql('CREATE INDEX IDX_BDA0F2DB17C13F8B ON build (build_id)');
    }
}
