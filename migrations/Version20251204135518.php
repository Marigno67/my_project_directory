<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204135518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arme ADD element_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE arme ADD CONSTRAINT FK_182073791F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
        $this->addSql('CREATE INDEX IDX_182073791F1F2A24 ON arme (element_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arme DROP FOREIGN KEY FK_182073791F1F2A24');
        $this->addSql('DROP INDEX IDX_182073791F1F2A24 ON arme');
        $this->addSql('ALTER TABLE arme DROP element_id');
    }
}
