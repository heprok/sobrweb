<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615093945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sobr.event (drec timestamp with time zone DEFAULT "now"(), type VARCHAR(1) NOT NULL, source VARCHAR(1) NOT NULL, text VARCHAR(128) NOT NULL, code SMALLINT NOT NULL, PRIMARY KEY(drec))');
        $this->addSql('CREATE INDEX IDX_2C2922628CDE5729 ON sobr.event (type)');
        $this->addSql('CREATE INDEX IDX_2C2922625F8A7F73 ON sobr.event (source)');
        $this->addSql('COMMENT ON COLUMN sobr.event.drec IS \'Начало события\'');
        $this->addSql('CREATE TABLE sobr.event_source (id VARCHAR(1) NOT NULL, name VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE sobr.event_source IS \'Источник события\'');
        $this->addSql('COMMENT ON COLUMN sobr.event_source.name IS \'Название события\'');
        $this->addSql('CREATE TABLE sobr.event_type (id VARCHAR(1) NOT NULL, name VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE sobr.event_type IS \'Типы события\'');
        $this->addSql('ALTER TABLE sobr.event ADD CONSTRAINT FK_2C2922628CDE5729 FOREIGN KEY (type) REFERENCES sobr.event_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sobr.event ADD CONSTRAINT FK_2C2922625F8A7F73 FOREIGN KEY (source) REFERENCES sobr.event_source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sobr.event DROP CONSTRAINT FK_2C2922625F8A7F73');
        $this->addSql('ALTER TABLE sobr.event DROP CONSTRAINT FK_2C2922628CDE5729');
        $this->addSql('DROP TABLE sobr.event');
        $this->addSql('DROP TABLE sobr.event_source');
        $this->addSql('DROP TABLE sobr.event_type');
    }
}
