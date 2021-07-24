<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724084131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sobr.people_to_duty DROP CONSTRAINT fk_2f76d123a1f9ec1');
        $this->addSql('DROP SEQUENCE sobr.group_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE sobr.group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dic.duty (id CHAR(2) NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE dic.duty IS \'Список должностей\'');
        $this->addSql('DROP TABLE sobr.duty');
        $this->addSql('DROP TABLE sobr.duty');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sobr.people_to_duty DROP CONSTRAINT FK_59C1E1453A1F9EC1');
        $this->addSql('DROP SEQUENCE sobr.group_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE sobr.group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sobr.duty (id CHAR(2) NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON TABLE sobr.duty IS \'Список должностей\'');
        $this->addSql('DROP TABLE dic.duty');
    }
}
