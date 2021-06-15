<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615075255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ds.people_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds.people (id INT NOT NULL, fam VARCHAR(30) NOT NULL, nam VARCHAR(30) DEFAULT NULL, pat VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE ds.people IS \'Люди\'');
        $this->addSql('COMMENT ON COLUMN ds.people.fam IS \'Фамилия\'');
        $this->addSql('COMMENT ON COLUMN ds.people.nam IS \'Имя\'');
        $this->addSql('COMMENT ON COLUMN ds.people.pat IS \'Отчество\'');
        $this->addSql('CREATE TABLE people_to_duty (people_id INT NOT NULL, duty_id CHAR(2) NOT NULL, PRIMARY KEY(people_id, duty_id))');
        $this->addSql('CREATE INDEX IDX_2F76D123147C936 ON people_to_duty (people_id)');
        $this->addSql('CREATE INDEX IDX_2F76D123A1F9EC1 ON people_to_duty (duty_id)');
        $this->addSql('ALTER TABLE people_to_duty ADD CONSTRAINT FK_2F76D123147C936 FOREIGN KEY (people_id) REFERENCES ds.people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE people_to_duty ADD CONSTRAINT FK_2F76D123A1F9EC1 FOREIGN KEY (duty_id) REFERENCES ds.duty (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE people_to_duty DROP CONSTRAINT FK_2F76D123147C936');
        $this->addSql('DROP SEQUENCE ds.people_id_seq CASCADE');
        $this->addSql('DROP TABLE ds.people');
        $this->addSql('DROP TABLE people_to_duty');
    }
}
