<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615094144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ds.group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds."group" (id INT NOT NULL, species_id CHAR(2) NOT NULL, dry BOOLEAN NOT NULL, qualities INT NOT NULL, thickness SMALLINT NOT NULL, width SMALLINT NOT NULL, min_length SMALLINT NOT NULL, max_length SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7A476C00B2A1D860 ON ds."group" (species_id)');
        $this->addSql('COMMENT ON TABLE ds."group" IS \'Группы параметров досок\'');
        $this->addSql('ALTER TABLE ds."group" ADD CONSTRAINT FK_7A476C00B2A1D860 FOREIGN KEY (species_id) REFERENCES dic.species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ds.group_id_seq CASCADE');
        $this->addSql('DROP TABLE ds."group"');
    }
}
