<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210220162004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE date_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE date (id INT NOT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE rendez_vous ADD date_id INT NOT NULL');
        $this->addSql('ALTER TABLE rendez_vous ALTER fiche_id DROP NOT NULL');
        $this->addSql('ALTER TABLE rendez_vous RENAME COLUMN date TO heure');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AB897366B FOREIGN KEY (date_id) REFERENCES date (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_65E8AA0AB897366B ON rendez_vous (date_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rendez_vous DROP CONSTRAINT FK_65E8AA0AB897366B');
        $this->addSql('DROP SEQUENCE date_id_seq CASCADE');
        $this->addSql('DROP TABLE date');
        $this->addSql('DROP INDEX IDX_65E8AA0AB897366B');
        $this->addSql('ALTER TABLE rendez_vous DROP date_id');
        $this->addSql('ALTER TABLE rendez_vous ALTER fiche_id SET NOT NULL');
        $this->addSql('ALTER TABLE rendez_vous RENAME COLUMN heure TO date');
    }
}
