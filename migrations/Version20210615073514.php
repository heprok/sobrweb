<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615073514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA sobr');
        $this->addSql('CREATE TABLE sobr.standard_length (standard SMALLINT NOT NULL, minimum SMALLINT NOT NULL, maximum SMALLINT NOT NULL, PRIMARY KEY(standard))');
        $this->addSql('COMMENT ON TABLE sobr.standard_length IS \'Cтандартные длины\'');
        $this->addSql('COMMENT ON COLUMN sobr.standard_length.minimum IS \'Минимальная граница диапзаона не включая, мм\'');
        $this->addSql('COMMENT ON COLUMN sobr.standard_length.maximum IS \'Максимальная граница диапзаона не включая, мм\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE sobr.standard_length');
    }
}
