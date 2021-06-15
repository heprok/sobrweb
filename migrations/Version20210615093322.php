<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615093322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ds.downtime_cause_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds.downtime_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds.downtime_location_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds.downtime_place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds.break_shedule (start INT NOT NULL, place_id INT NOT NULL, cause_id INT NOT NULL, stop INT NOT NULL, PRIMARY KEY(start))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_814608AEB95616B6 ON ds.break_shedule (stop)');
        $this->addSql('CREATE INDEX IDX_814608AEDA6A219 ON ds.break_shedule (place_id)');
        $this->addSql('CREATE INDEX IDX_814608AE66E2221E ON ds.break_shedule (cause_id)');
        $this->addSql('COMMENT ON TABLE ds.break_shedule IS \'График перерывов\'');
        $this->addSql('COMMENT ON COLUMN ds.break_shedule.start IS \'Начало перерыва в формате HHMM\'');
        $this->addSql('COMMENT ON COLUMN ds.break_shedule.stop IS \'Конец перерыва в формате HHMM\'');
        $this->addSql('CREATE TABLE ds.downtime (period tstzrange NOT NULL, cause_id INT DEFAULT NULL, place_id INT DEFAULT NULL, finish TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(period))');
        $this->addSql('CREATE INDEX IDX_8B6D12BD66E2221E ON ds.downtime (cause_id)');
        $this->addSql('CREATE INDEX IDX_8B6D12BDDA6A219 ON ds.downtime (place_id)');
        $this->addSql('COMMENT ON TABLE ds.downtime IS \'Простои\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime.period IS \'Время начала простоя\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime.finish IS \'Время окончания простоя\'');
        $this->addSql('CREATE TABLE ds.downtime_cause (id INT NOT NULL, group_id INT NOT NULL, text VARCHAR(128) NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2BA8CD5FE54D947 ON ds.downtime_cause (group_id)');
        $this->addSql('COMMENT ON TABLE ds.downtime_cause IS \'Причины простоя\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_cause.text IS \'Название причины\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_cause.enabled IS \'Используется\'');
        $this->addSql('CREATE TABLE ds.downtime_group (id INT NOT NULL, text VARCHAR(128) NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE ds.downtime_group IS \'Группы причин простоя\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_group.text IS \'Название причины\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_group.enabled IS \'Используется\'');
        $this->addSql('CREATE TABLE ds.downtime_location (id INT NOT NULL, text VARCHAR(128) NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE ds.downtime_location IS \'Локации простоя\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_location.text IS \'Название причины\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_location.enabled IS \'Используется\'');
        $this->addSql('CREATE TABLE ds.downtime_place (id INT NOT NULL, location_id INT NOT NULL, text VARCHAR(128) NOT NULL, enabled BOOLEAN DEFAULT \'true\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_667DA0A764D218E ON ds.downtime_place (location_id)');
        $this->addSql('COMMENT ON TABLE ds.downtime_place IS \'Места простоя\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_place.text IS \'Название места\'');
        $this->addSql('COMMENT ON COLUMN ds.downtime_place.enabled IS \'Используется\'');
        $this->addSql('ALTER TABLE ds.break_shedule ADD CONSTRAINT FK_814608AEDA6A219 FOREIGN KEY (place_id) REFERENCES ds.downtime_place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ds.break_shedule ADD CONSTRAINT FK_814608AE66E2221E FOREIGN KEY (cause_id) REFERENCES ds.downtime_cause (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ds.downtime ADD CONSTRAINT FK_8B6D12BD66E2221E FOREIGN KEY (cause_id) REFERENCES ds.downtime_cause (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ds.downtime ADD CONSTRAINT FK_8B6D12BDDA6A219 FOREIGN KEY (place_id) REFERENCES ds.downtime_place (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ds.downtime_cause ADD CONSTRAINT FK_E2BA8CD5FE54D947 FOREIGN KEY (group_id) REFERENCES ds.downtime_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ds.downtime_place ADD CONSTRAINT FK_667DA0A764D218E FOREIGN KEY (location_id) REFERENCES ds.downtime_location (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ds.break_shedule DROP CONSTRAINT FK_814608AE66E2221E');
        $this->addSql('ALTER TABLE ds.downtime DROP CONSTRAINT FK_8B6D12BD66E2221E');
        $this->addSql('ALTER TABLE ds.downtime_cause DROP CONSTRAINT FK_E2BA8CD5FE54D947');
        $this->addSql('ALTER TABLE ds.downtime_place DROP CONSTRAINT FK_667DA0A764D218E');
        $this->addSql('ALTER TABLE ds.break_shedule DROP CONSTRAINT FK_814608AEDA6A219');
        $this->addSql('ALTER TABLE ds.downtime DROP CONSTRAINT FK_8B6D12BDDA6A219');
        $this->addSql('DROP SEQUENCE ds.downtime_cause_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds.downtime_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds.downtime_location_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds.downtime_place_id_seq CASCADE');
        $this->addSql('DROP TABLE ds.break_shedule');
        $this->addSql('DROP TABLE ds.downtime');
        $this->addSql('DROP TABLE ds.downtime_cause');
        $this->addSql('DROP TABLE ds.downtime_group');
        $this->addSql('DROP TABLE ds.downtime_location');
        $this->addSql('DROP TABLE ds.downtime_place');
    }
}
