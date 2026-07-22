<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260722090046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__appointment AS SELECT id, first_name, last_name, email, phone, date, time, message, specialty_id FROM appointment');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, message CLOB DEFAULT NULL, specialty_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, doctor_id INTEGER DEFAULT NULL, CONSTRAINT FK_FE38F8449A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FE38F844A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO appointment (id, first_name, last_name, email, phone, date, time, message, specialty_id) SELECT id, first_name, last_name, email, phone, date, time, message, specialty_id FROM __temp__appointment');
        $this->addSql('DROP TABLE __temp__appointment');
        $this->addSql('CREATE INDEX IDX_FE38F8449A353316 ON appointment (specialty_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844A76ED395 ON appointment (user_id)');
        $this->addSql('CREATE INDEX IDX_FE38F84487F4FB17 ON appointment (doctor_id)');
        $this->addSql('ALTER TABLE user ADD COLUMN last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN phone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__appointment AS SELECT id, first_name, last_name, email, phone, date, time, message, specialty_id FROM appointment');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, message CLOB DEFAULT NULL, specialty_id INTEGER NOT NULL, CONSTRAINT FK_FE38F8449A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO appointment (id, first_name, last_name, email, phone, date, time, message, specialty_id) SELECT id, first_name, last_name, email, phone, date, time, message, specialty_id FROM __temp__appointment');
        $this->addSql('DROP TABLE __temp__appointment');
        $this->addSql('CREATE INDEX IDX_FE38F8449A353316 ON appointment (specialty_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password) SELECT id, email, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }
}
