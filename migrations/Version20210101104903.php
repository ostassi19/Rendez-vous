<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101104903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT fk_1bda53c64de7dc5c');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT fk_1bda53c6e7a1254a');
        $this->addSql('DROP INDEX idx_1bda53c6e7a1254a');
        $this->addSql('DROP INDEX idx_1bda53c64de7dc5c');
        $this->addSql('ALTER TABLE medecin ADD tel VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD fixe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD pays VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD region VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD code_postal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin DROP adresse_id');
        $this->addSql('ALTER TABLE medecin DROP contact_id');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7eb4de7dc5c');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT fk_1adad7ebe7a1254a');
        $this->addSql('DROP INDEX idx_1adad7eb4de7dc5c');
        $this->addSql('DROP INDEX idx_1adad7ebe7a1254a');
        $this->addSql('ALTER TABLE patient ADD tel VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD fixe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD pays VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD region VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD code_postal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient DROP adresse_id');
        $this->addSql('ALTER TABLE patient DROP contact_id');
        $this->addSql('ALTER TABLE secretaire DROP CONSTRAINT fk_7db5c2d04de7dc5c');
        $this->addSql('ALTER TABLE secretaire DROP CONSTRAINT fk_7db5c2d0e7a1254a');
        $this->addSql('DROP INDEX idx_7db5c2d0e7a1254a');
        $this->addSql('DROP INDEX idx_7db5c2d04de7dc5c');
        $this->addSql('ALTER TABLE secretaire ADD tel VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD fixe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD pays VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD region VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD code_postal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire DROP adresse_id');
        $this->addSql('ALTER TABLE secretaire DROP contact_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE medecin ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin ADD contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medecin DROP tel');
        $this->addSql('ALTER TABLE medecin DROP fixe');
        $this->addSql('ALTER TABLE medecin DROP email');
        $this->addSql('ALTER TABLE medecin DROP ville');
        $this->addSql('ALTER TABLE medecin DROP pays');
        $this->addSql('ALTER TABLE medecin DROP region');
        $this->addSql('ALTER TABLE medecin DROP code_postal');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT fk_1bda53c64de7dc5c FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT fk_1bda53c6e7a1254a FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1bda53c6e7a1254a ON medecin (contact_id)');
        $this->addSql('CREATE INDEX idx_1bda53c64de7dc5c ON medecin (adresse_id)');
        $this->addSql('ALTER TABLE secretaire ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire ADD contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secretaire DROP tel');
        $this->addSql('ALTER TABLE secretaire DROP fixe');
        $this->addSql('ALTER TABLE secretaire DROP email');
        $this->addSql('ALTER TABLE secretaire DROP ville');
        $this->addSql('ALTER TABLE secretaire DROP pays');
        $this->addSql('ALTER TABLE secretaire DROP region');
        $this->addSql('ALTER TABLE secretaire DROP code_postal');
        $this->addSql('ALTER TABLE secretaire ADD CONSTRAINT fk_7db5c2d04de7dc5c FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE secretaire ADD CONSTRAINT fk_7db5c2d0e7a1254a FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7db5c2d0e7a1254a ON secretaire (contact_id)');
        $this->addSql('CREATE INDEX idx_7db5c2d04de7dc5c ON secretaire (adresse_id)');
        $this->addSql('ALTER TABLE patient ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient DROP tel');
        $this->addSql('ALTER TABLE patient DROP fixe');
        $this->addSql('ALTER TABLE patient DROP email');
        $this->addSql('ALTER TABLE patient DROP ville');
        $this->addSql('ALTER TABLE patient DROP pays');
        $this->addSql('ALTER TABLE patient DROP region');
        $this->addSql('ALTER TABLE patient DROP code_postal');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7eb4de7dc5c FOREIGN KEY (adresse_id) REFERENCES adresse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT fk_1adad7ebe7a1254a FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1adad7eb4de7dc5c ON patient (adresse_id)');
        $this->addSql('CREATE INDEX idx_1adad7ebe7a1254a ON patient (contact_id)');
    }
}
