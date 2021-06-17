<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617144512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TYPE int2range AS RANGE (
            subtype = int2
        )');
        $this->addSql('ALTER TABLE sobr.standard_length ADD range int2range NOT NULL');
        $this->addSql('ALTER TABLE sobr.standard_length DROP minimum');
        $this->addSql('ALTER TABLE sobr.standard_length DROP maximum');
        $this->addSql('COMMENT ON COLUMN sobr.standard_length.range IS \'Диапазон фактических длин, мм\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sobr.standard_length ADD minimum SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE sobr.standard_length ADD maximum SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE sobr.standard_length DROP range');
        $this->addSql('COMMENT ON COLUMN sobr.standard_length.minimum IS \'Минимальная граница диапзаона не включая, мм\'');
        $this->addSql('COMMENT ON COLUMN sobr.standard_length.maximum IS \'Максимальная граница диапзаона не включая, мм\'');
    }
}
