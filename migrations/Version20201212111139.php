<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212111139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE adresse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medecin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE secretaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE adresse (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, tel VARCHAR(255) DEFAULT NULL, fixe VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, adresse_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1BDA53C64DE7DC5C ON medecin (adresse_id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C6E7A1254A ON medecin (contact_id)');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, adresse_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, cnss VARCHAR(255) NOT NULL, cnrps VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB4DE7DC5C ON patient (adresse_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EBE7A1254A ON patient (contact_id)');
        $this->addSql('CREATE TABLE secretaire (id INT NOT NULL, adresse_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7DB5C2D04DE7DC5C ON secretaire (adresse_id)');
        $this->addSql('CREATE INDEX IDX_7DB5C2D0E7A1254A ON secretaire (contact_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C64DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secretaire ADD CONSTRAINT FK_7DB5C2D04DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secretaire ADD CONSTRAINT FK_7DB5C2D0E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C64DE7DC5C');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB4DE7DC5C');
        $this->addSql('ALTER TABLE secretaire DROP CONSTRAINT FK_7DB5C2D04DE7DC5C');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C6E7A1254A');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBE7A1254A');
        $this->addSql('ALTER TABLE secretaire DROP CONSTRAINT FK_7DB5C2D0E7A1254A');
        $this->addSql('DROP SEQUENCE adresse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medecin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE secretaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE secretaire');
        $this->addSql('DROP TABLE users');
    }
}
