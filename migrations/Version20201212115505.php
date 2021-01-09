<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212115505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE specialite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE specialite (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE medecin ADD specialite_id INT NOT NULL');
        $this->addSql('ALTER TABLE medecin ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE medecin ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE medecin ADD cin VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C62195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1BDA53C62195E0F0 ON medecin (specialite_id)');
        $this->addSql('ALTER TABLE patient ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD cin VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE secretaire ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE secretaire ADD cin VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD roles TEXT NOT NULL');
        $this->addSql('ALTER TABLE users ADD password_change_date INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD confirmation_token VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD id_personne INT NOT NULL');
        $this->addSql('ALTER TABLE users DROP nom');
        $this->addSql('ALTER TABLE users DROP prenom');
        $this->addSql('ALTER TABLE users DROP user_name');
        $this->addSql('ALTER TABLE users DROP role');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C62195E0F0');
        $this->addSql('DROP SEQUENCE specialite_id_seq CASCADE');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('ALTER TABLE users ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD user_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users DROP username');
        $this->addSql('ALTER TABLE users DROP password');
        $this->addSql('ALTER TABLE users DROP name');
        $this->addSql('ALTER TABLE users DROP email');
        $this->addSql('ALTER TABLE users DROP roles');
        $this->addSql('ALTER TABLE users DROP password_change_date');
        $this->addSql('ALTER TABLE users DROP confirmation_token');
        $this->addSql('ALTER TABLE users DROP id_personne');
        $this->addSql('DROP INDEX IDX_1BDA53C62195E0F0');
        $this->addSql('ALTER TABLE medecin DROP specialite_id');
        $this->addSql('ALTER TABLE medecin DROP nom');
        $this->addSql('ALTER TABLE medecin DROP prenom');
        $this->addSql('ALTER TABLE medecin DROP cin');
        $this->addSql('ALTER TABLE patient DROP nom');
        $this->addSql('ALTER TABLE patient DROP prenom');
        $this->addSql('ALTER TABLE patient DROP cin');
        $this->addSql('ALTER TABLE secretaire DROP nom');
        $this->addSql('ALTER TABLE secretaire DROP prenom');
        $this->addSql('ALTER TABLE secretaire DROP cin');
    }
}
