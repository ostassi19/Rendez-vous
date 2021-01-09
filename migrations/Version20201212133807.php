<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212133807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE consultation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ordonnance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rendez_vous_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE soin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_soin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE consultation (id INT NOT NULL, fiche_id INT DEFAULT NULL, motif TEXT DEFAULT NULL, examen TEXT DEFAULT NULL, remarque TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_964685A6DF522508 ON consultation (fiche_id)');
        $this->addSql('CREATE TABLE ordonnance (id INT NOT NULL, consultation_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_924B326C62FF6CDF ON ordonnance (consultation_id)');
        $this->addSql('CREATE TABLE rendez_vous (id INT NOT NULL, fiche_id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65E8AA0ADF522508 ON rendez_vous (fiche_id)');
        $this->addSql('CREATE TABLE soin (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_soin (id INT NOT NULL, soin_id INT DEFAULT NULL, ordonnance_id INT DEFAULT NULL, traitement VARCHAR(255) DEFAULT NULL, duree INT DEFAULT NULL, remarque TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D27F05CA6F952169 ON type_soin (soin_id)');
        $this->addSql('CREATE INDEX IDX_D27F05CA2BF23B8F ON type_soin (ordonnance_id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C62FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0ADF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_soin ADD CONSTRAINT FK_D27F05CA6F952169 FOREIGN KEY (soin_id) REFERENCES soin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_soin ADD CONSTRAINT FK_D27F05CA2BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ordonnance DROP CONSTRAINT FK_924B326C62FF6CDF');
        $this->addSql('ALTER TABLE type_soin DROP CONSTRAINT FK_D27F05CA2BF23B8F');
        $this->addSql('ALTER TABLE type_soin DROP CONSTRAINT FK_D27F05CA6F952169');
        $this->addSql('DROP SEQUENCE consultation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ordonnance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rendez_vous_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE soin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_soin_id_seq CASCADE');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE soin');
        $this->addSql('DROP TABLE type_soin');
    }
}
