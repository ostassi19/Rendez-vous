<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212135340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rapport_medical_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rapport_medical (id INT NOT NULL, fiche_id INT DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, rapport JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C0B6739DF522508 ON rapport_medical (fiche_id)');
        $this->addSql('ALTER TABLE rapport_medical ADD CONSTRAINT FK_C0B6739DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consultation ADD date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE rapport_medical_id_seq CASCADE');
        $this->addSql('DROP TABLE rapport_medical');
        $this->addSql('ALTER TABLE consultation DROP date');
    }
}
