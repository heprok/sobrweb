<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618093006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sobr.shift (period tstzrange NOT NULL, people_id INT DEFAULT NULL, number SMALLINT NOT NULL, PRIMARY KEY(period))');
        $this->addSql('CREATE INDEX IDX_CA98D6423147C936 ON sobr.shift (people_id)');
        $this->addSql('COMMENT ON TABLE sobr.shift IS \'Смены\'');
        $this->addSql('COMMENT ON COLUMN sobr.shift.period IS \'Время начала смены\'');
        $this->addSql('COMMENT ON COLUMN sobr.shift.number IS \'Номер смены\'');
        $this->addSql('ALTER TABLE sobr.shift ADD CONSTRAINT FK_CA98D6423147C936 FOREIGN KEY (people_id) REFERENCES sobr.people (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE sobr.shift');
    }
}
