<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617125647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sobr.group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sobr."group" (id INT NOT NULL, species_id CHAR(2) NOT NULL, dry BOOLEAN NOT NULL, qualities INT NOT NULL, thickness SMALLINT NOT NULL, width SMALLINT NOT NULL, min_length SMALLINT NOT NULL, max_length SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97769EBB2A1D860 ON sobr."group" (species_id)');
        $this->addSql('COMMENT ON TABLE sobr."group" IS \'Группы параметров досок\'');
        $this->addSql('ALTER TABLE sobr."group" ADD CONSTRAINT FK_97769EBB2A1D860 FOREIGN KEY (species_id) REFERENCES dic.species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX sobr.uniq_814608aeb95616b6 RENAME TO UNIQ_7605134BB95616B6');
        $this->addSql('ALTER INDEX sobr.idx_814608aeda6a219 RENAME TO IDX_7605134BDA6A219');
        $this->addSql('ALTER INDEX sobr.idx_814608ae66e2221e RENAME TO IDX_7605134B66E2221E');
        $this->addSql('ALTER INDEX sobr.idx_8b6d12bd66e2221e RENAME TO IDX_B511A79D66E2221E');
        $this->addSql('ALTER INDEX sobr.idx_8b6d12bdda6a219 RENAME TO IDX_B511A79DDA6A219');
        $this->addSql('ALTER INDEX sobr.idx_e2ba8cd5fe54d947 RENAME TO IDX_322DD939FE54D947');
        $this->addSql('ALTER INDEX sobr.idx_667da0a764d218e RENAME TO IDX_B6EAF54B64D218E');
        $this->addSql('ALTER INDEX sobr.idx_2c2922628cde5729 RENAME TO IDX_543DE7A08CDE5729');
        $this->addSql('ALTER INDEX sobr.idx_2c2922625f8a7f73 RENAME TO IDX_543DE7A05F8A7F73');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE sobr.group_id_seq CASCADE');
        $this->addSql('DROP TABLE sobr."group"');
        $this->addSql('ALTER INDEX sobr.idx_b6eaf54b64d218e RENAME TO idx_667da0a764d218e');
        $this->addSql('ALTER INDEX sobr.uniq_7605134bb95616b6 RENAME TO uniq_814608aeb95616b6');
        $this->addSql('ALTER INDEX sobr.idx_7605134bda6a219 RENAME TO idx_814608aeda6a219');
        $this->addSql('ALTER INDEX sobr.idx_7605134b66e2221e RENAME TO idx_814608ae66e2221e');
        $this->addSql('ALTER INDEX sobr.idx_322dd939fe54d947 RENAME TO idx_e2ba8cd5fe54d947');
        $this->addSql('ALTER INDEX sobr.idx_b511a79dda6a219 RENAME TO idx_8b6d12bdda6a219');
        $this->addSql('ALTER INDEX sobr.idx_b511a79d66e2221e RENAME TO idx_8b6d12bd66e2221e');
        $this->addSql('ALTER INDEX sobr.idx_543de7a08cde5729 RENAME TO idx_2c2922628cde5729');
        $this->addSql('ALTER INDEX sobr.idx_543de7a05f8a7f73 RENAME TO idx_2c2922625f8a7f73');
    }
}
