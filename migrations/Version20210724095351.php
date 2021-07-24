<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724095351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dic.gost_2708 (diam SMALLINT NOT NULL, length SMALLINT NOT NULL, volume DOUBLE PRECISION NOT NULL, PRIMARY KEY(diam, length))');
        $this->addSql('COMMENT ON TABLE dic.gost_2708 IS \'Лесоматериалы круглые. Таблица объёмов по ГОСТ 2708-75\'');
        $this->addSql('COMMENT ON COLUMN dic.gost_2708.diam IS \'Диаметр вершины в диапазоне 3 - 120 см.\'');
        $this->addSql('COMMENT ON COLUMN dic.gost_2708.length IS \'Длина в дипазоне 1 - 9.5 м.\'');
        $this->addSql('COMMENT ON COLUMN dic.gost_2708.volume IS \'Объём м³.\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE dic.gost_2708');
    }
}
