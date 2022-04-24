<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424143400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark ADD assignment_1 DOUBLE PRECISION NOT NULL, ADD assignment_2 DOUBLE PRECISION NOT NULL, DROP mark1, DROP mark2');
        $this->addSql('ALTER TABLE subject ADD subject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A23EDC87 ON subject (subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark ADD mark1 DOUBLE PRECISION NOT NULL, ADD mark2 DOUBLE PRECISION NOT NULL, DROP assignment_1, DROP assignment_2');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A23EDC87');
        $this->addSql('DROP INDEX IDX_FBCE3E7A23EDC87 ON subject');
        $this->addSql('ALTER TABLE subject DROP subject_id');
    }
}
