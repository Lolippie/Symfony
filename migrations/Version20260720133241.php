<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260720133241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doctor_specialty (doctor_id INTEGER NOT NULL, specialty_id INTEGER NOT NULL, PRIMARY KEY (doctor_id, specialty_id), CONSTRAINT FK_2F74C70787F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2F74C7079A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2F74C70787F4FB17 ON doctor_specialty (doctor_id)');
        $this->addSql('CREATE INDEX IDX_2F74C7079A353316 ON doctor_specialty (specialty_id)');
        $this->addSql('CREATE TABLE specialty (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE doctor_specialty');
        $this->addSql('DROP TABLE specialty');
    }
}
