<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212140923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE fiche ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE rapport_medical ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_medical ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_medical ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport_medical ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE soin ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE soin ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE soin ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE soin ADD is_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE type_soin ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE type_soin ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE type_soin ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE type_soin ADD is_deleted BOOLEAN NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fiche DROP created_at');
        $this->addSql('ALTER TABLE fiche DROP updated_at');
        $this->addSql('ALTER TABLE fiche DROP deleted_at');
        $this->addSql('ALTER TABLE fiche DROP is_deleted');
        $this->addSql('ALTER TABLE rapport_medical DROP created_at');
        $this->addSql('ALTER TABLE rapport_medical DROP updated_at');
        $this->addSql('ALTER TABLE rapport_medical DROP deleted_at');
        $this->addSql('ALTER TABLE rapport_medical DROP is_deleted');
        $this->addSql('ALTER TABLE consultation DROP created_at');
        $this->addSql('ALTER TABLE consultation DROP updated_at');
        $this->addSql('ALTER TABLE consultation DROP deleted_at');
        $this->addSql('ALTER TABLE consultation DROP is_deleted');
        $this->addSql('ALTER TABLE rendez_vous DROP created_at');
        $this->addSql('ALTER TABLE rendez_vous DROP updated_at');
        $this->addSql('ALTER TABLE rendez_vous DROP deleted_at');
        $this->addSql('ALTER TABLE rendez_vous DROP is_deleted');
        $this->addSql('ALTER TABLE soin DROP created_at');
        $this->addSql('ALTER TABLE soin DROP updated_at');
        $this->addSql('ALTER TABLE soin DROP deleted_at');
        $this->addSql('ALTER TABLE soin DROP is_deleted');
        $this->addSql('ALTER TABLE ordonnance DROP created_at');
        $this->addSql('ALTER TABLE ordonnance DROP updated_at');
        $this->addSql('ALTER TABLE ordonnance DROP deleted_at');
        $this->addSql('ALTER TABLE ordonnance DROP is_deleted');
        $this->addSql('ALTER TABLE type_soin DROP created_at');
        $this->addSql('ALTER TABLE type_soin DROP updated_at');
        $this->addSql('ALTER TABLE type_soin DROP deleted_at');
        $this->addSql('ALTER TABLE type_soin DROP is_deleted');
    }
}
