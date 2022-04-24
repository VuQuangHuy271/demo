<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424103938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD specialized_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33AD29D48F FOREIGN KEY (specialized_id) REFERENCES specialized (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33AD29D48F ON student (specialized_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33AD29D48F');
        $this->addSql('DROP INDEX IDX_B723AF33AD29D48F ON student');
        $this->addSql('ALTER TABLE student DROP specialized_id');
    }
}
