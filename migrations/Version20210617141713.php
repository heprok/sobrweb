<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617141713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sobr.shift_shedule (start INT NOT NULL, stop INT NOT NULL, name VARCHAR(128) NOT NULL, PRIMARY KEY(start))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62046D97B95616B6 ON sobr.shift_shedule (stop)');
        $this->addSql('COMMENT ON TABLE sobr.shift_shedule IS \'График сменов\'');
        $this->addSql('COMMENT ON COLUMN sobr.shift_shedule.start IS \'Начало смены\'');
        $this->addSql('COMMENT ON COLUMN sobr.shift_shedule.stop IS \'Конец смены\'');
        $this->addSql('COMMENT ON COLUMN sobr.shift_shedule.name IS \'Наименование смены\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE sobr.shift_shedule');
    }
}
