<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702212836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ALTER date_enregistrement TYPE TIMESTAMP(0) WITHOUT TIME ZONE USING date_enregistrement::timestamp(0) without time zone');
        $this->addSql('ALTER TABLE produit ALTER date_enregistrement DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN produit.date_enregistrement IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE produit ALTER date_enregistrement TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE produit ALTER date_enregistrement DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN produit.date_enregistrement IS NULL');
    }
}
