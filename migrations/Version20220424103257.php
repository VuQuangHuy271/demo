<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424103257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specialized (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, specialized_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, image VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_B723AF33AD29D48F (specialized_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, specialized_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, image VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_B0F6A6D5AD29D48F (specialized_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33AD29D48F FOREIGN KEY (specialized_id) REFERENCES specialized (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5AD29D48F FOREIGN KEY (specialized_id) REFERENCES specialized (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33AD29D48F');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5AD29D48F');
        $this->addSql('DROP TABLE specialized');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE teacher');
    }
}
