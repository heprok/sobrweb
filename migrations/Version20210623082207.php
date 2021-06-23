<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623082207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sobr.provider_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sobr.stack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sobr.timber_quality_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sobr.transport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('CREATE TABLE sobr.provider (id INT NOT NULL, name VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_155D2A295E237E06 ON sobr.provider (name)');
        $this->addSql('COMMENT ON TABLE sobr.provider IS \'Поставщики\'');
        $this->addSql('COMMENT ON COLUMN sobr.provider.id IS \'Id поставщика\'');
        $this->addSql('COMMENT ON COLUMN sobr.provider.name IS \'Имя поставщика\'');

        $this->addSql('CREATE TABLE sobr.stack (id INT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2E3B966D5E237E06 ON sobr.stack (name)');
        $this->addSql('COMMENT ON TABLE sobr.stack IS \'Штабели\'');
        $this->addSql('COMMENT ON COLUMN sobr.stack.id IS \'Id штабеля\'');
        $this->addSql('COMMENT ON COLUMN sobr.stack.name IS \'Название\'');

        $this->addSql('CREATE TABLE sobr.timber_quality (id INT NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CA2E4A045E237E06 ON sobr.timber_quality (name)');
        $this->addSql('COMMENT ON TABLE sobr.timber_quality IS \'Качества брёвен\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber_quality.id IS \'Id качества\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber_quality.name IS \'Название качества\'');

        $this->addSql('CREATE TABLE sobr.transport (id INT NOT NULL, name VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD27FF745E237E06 ON sobr.transport (name)');
        $this->addSql('COMMENT ON TABLE sobr.transport IS \'Транспорт\'');
        $this->addSql('COMMENT ON COLUMN sobr.transport.id IS \'Id транспорта\'');
        $this->addSql('COMMENT ON COLUMN sobr.transport.name IS \'Название\'');

        $this->addSql('ALTER INDEX sobr.idx_2f76d123147c936 RENAME TO IDX_59C1E1453147C936');
        $this->addSql('ALTER INDEX sobr.idx_2f76d123a1f9ec1 RENAME TO IDX_59C1E1453A1F9EC1');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE sobr.provider_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sobr.stack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sobr.timber_quality_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sobr.transport_id_seq CASCADE');
        $this->addSql('DROP TABLE sobr.provider');
        $this->addSql('DROP TABLE sobr.stack');
        $this->addSql('DROP TABLE sobr.timber_quality');
        $this->addSql('DROP TABLE sobr.transport');
        $this->addSql('ALTER INDEX sobr.idx_59c1e1453147c936 RENAME TO idx_2f76d123147c936');
        $this->addSql('ALTER INDEX sobr.idx_59c1e1453a1f9ec1 RENAME TO idx_2f76d123a1f9ec1');
    }
}
