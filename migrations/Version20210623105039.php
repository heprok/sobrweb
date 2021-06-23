<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623105039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sobr.batch_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sobr.batch (id INT NOT NULL, provider_id INT NOT NULL, transport_id INT NOT NULL, waybill VARCHAR(64) NOT NULL, number VARCHAR(64) DEFAULT NULL, repeat BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9798BFD3A53A8AA ON sobr.batch (provider_id)');
        $this->addSql('CREATE INDEX IDX_9798BFD39909C13F ON sobr.batch (transport_id)');
        $this->addSql('COMMENT ON TABLE sobr.batch IS \'Партия\'');
        $this->addSql('COMMENT ON COLUMN sobr.batch.provider_id IS \'Id поставщика\'');
        $this->addSql('COMMENT ON COLUMN sobr.batch.transport_id IS \'Id транспорта\'');
        $this->addSql('COMMENT ON COLUMN sobr.batch.waybill IS \'Накладная\'');
        $this->addSql('COMMENT ON COLUMN sobr.batch.number IS \'Номер транспорта\'');
        $this->addSql('COMMENT ON COLUMN sobr.batch.repeat IS \'Повторная сортировка (пересортировка)\'');
        $this->addSql('CREATE TABLE sobr.timber (drec TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, species_id CHAR(2) NOT NULL, batch_id INT NOT NULL, quality SMALLINT NOT NULL, top_diam SMALLINT NOT NULL, mid_diam SMALLINT NOT NULL, butt_diam SMALLINT NOT NULL, ovality DOUBLE PRECISION NOT NULL, length SMALLINT NOT NULL, top_taper SMALLINT NOT NULL, butt_taper SMALLINT NOT NULL, taper SMALLINT NOT NULL, sweep SMALLINT NOT NULL, pocket SMALLINT NOT NULL, PRIMARY KEY(drec))');
        $this->addSql('CREATE INDEX IDX_FC64264B2A1D860 ON sobr.timber (species_id)');
        $this->addSql('CREATE INDEX IDX_FC64264F39EBE7A ON sobr.timber (batch_id)');
        $this->addSql('COMMENT ON TABLE sobr.timber IS \'Брёвна\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.drec IS \'Дата записи\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.quality IS \'Качество бревна\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.top_diam IS \'Диаметр вершины, мм\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.mid_diam IS \'Диаметр центра, мм\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.butt_diam IS \'Диаметр комля, мм\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.ovality IS \'Овальность\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.length IS \'Длина бревна, мм.\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.top_taper IS \'Сбег вершины см/м\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.butt_taper IS \'Сбег комля см/м\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.taper IS \'Сбег см/м\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.sweep IS \'Кривизна, см/м\'');
        $this->addSql('COMMENT ON COLUMN sobr.timber.pocket IS \'Карман\'');
        $this->addSql('ALTER TABLE sobr.batch ADD CONSTRAINT FK_9798BFD3A53A8AA FOREIGN KEY (provider_id) REFERENCES sobr.provider (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sobr.batch ADD CONSTRAINT FK_9798BFD39909C13F FOREIGN KEY (transport_id) REFERENCES sobr.transport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sobr.timber ADD CONSTRAINT FK_FC64264B2A1D860 FOREIGN KEY (species_id) REFERENCES dic.species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sobr.timber ADD CONSTRAINT FK_FC64264F39EBE7A FOREIGN KEY (batch_id) REFERENCES sobr.batch (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sobr.timber DROP CONSTRAINT FK_FC64264F39EBE7A');
        $this->addSql('DROP SEQUENCE sobr.batch_id_seq CASCADE');
        $this->addSql('DROP TABLE sobr.batch');
        $this->addSql('DROP TABLE sobr.timber');
    }
}
