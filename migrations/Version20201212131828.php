<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212131828 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fiche (id INT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, antecedent_maladie TEXT DEFAULT NULL, abitude_vie TEXT DEFAULT NULL, histoire_maladie TEXT DEFAULT NULL, exploration TEXT DEFAULT NULL, diagnostic TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C13CC786B899279 ON fiche (patient_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC784F31A84 ON fiche (medecin_id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC786B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC784F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fiche_id_seq CASCADE');
        $this->addSql('DROP TABLE fiche');
    }
}
