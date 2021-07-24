<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724091308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE OR REPLACE FUNCTION "sobr"."qualities_string"( IN bits int ) RETURNS text AS $$
            BEGIN
            RETURN ( SELECT
                array_to_string(
                ARRAY( SELECT
                        name
                        FROM
                        "sobr"."quality"
                        WHERE
                        ( id::bit( 32 ) & $1::bit( 32 ) )::int != 0 ), ", " ) );
            END
            $$ LANGUAGE plpgsql;
        ');
        $this->addSql(
            "CREATE OR REPLACE FUNCTION sobr.fio( IN people_id int ) RETURNS text AS $$
                    DECLARE result text;
                    BEGIN
                    SELECT
                    fam || ' ' ||
                        CASE WHEN ( nam = '') IS NOT FALSE THEN '?' ELSE upper( left( trim( nam ), 1 ) ) END || '.' ||
                        CASE WHEN ( pat = '') IS NOT FALSE THEN '?' ELSE upper( left( trim( pat ), 1 ) ) END ||
                        '.' INTO result
                    FROM
                        sobr.people
                    WHERE
                        id = $1;

                    RETURN result;

                    END
                    $$ LANGUAGE plpgsql"
        );

        $this->addSql("CREATE OR REPLACE FUNCTION sobr.batch_info( IN b_id int ) RETURNS text AS $$
                        DECLARE result text;
                        BEGIN
                        SELECT
                            ( SELECT
                            to_char( drec, 'DD.MM.YY HH24:MI:SS')
                            FROM
                                sobr.batch_event
                            WHERE
                                batch_id = b_id
                            AND
                                state = 'st') || ' / ' ||
                            p.name || ' / ' ||
                            t.name || ' / ' INTO result
                        FROM
                            sobr.batch b
                        LEFT OUTER JOIN
                            sobr.provider p ON b.provider_id = p.id
                        LEFT OUTER JOIN
                            sobr.transport t ON b.transport_id = t.id
                        WHERE
                            b.id = b_id;

                        RETURN result;

                        END
                        $$ LANGUAGE plpgsql");

        $this->addSql(
            'CREATE OR REPLACE FUNCTION "sobr".standard_length( IN real_length int ) RETURNS int AS $$
                    DECLARE result int;
                    BEGIN
                    SELECT
                        standard INTO result
                    FROM
                        sobr.standard_length
                    WHERE
                        lower(range) < $1 AND $1 <= upper(range);

                    RETURN result;

                    END
                    $$ LANGUAGE plpgsql'
        );


        $this->addSql(
            'CREATE OR REPLACE FUNCTION "sobr".volume_timber ( IN real_length int, IN diam_timber double precision)
                            RETURNS numeric
                            AS $$
                        DECLARE
                            result numeric;
                        BEGIN
                            SELECT
                                volume INTO result
                            FROM
                                dic.gost_2708
                            WHERE
                                diam = diam_timber
                                AND
                                length = (sobr.standard_length (real_length) / 10 );
                            RETURN result;

                        END
                        $$ LANGUAGE plpgsql'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
