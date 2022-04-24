<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424213110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark ADD assignment_2 DOUBLE PRECISION NOT NULL, CHANGE mark assignment_1 DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE student ADD course_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33591CC992 ON student (course_id)');
        $this->addSql('ALTER TABLE subject ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mark ADD mark DOUBLE PRECISION NOT NULL, DROP assignment_1, DROP assignment_2');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33591CC992');
        $this->addSql('DROP INDEX IDX_B723AF33591CC992 ON student');
        $this->addSql('ALTER TABLE student DROP course_id');
        $this->addSql('ALTER TABLE subject DROP image');
    }
}
