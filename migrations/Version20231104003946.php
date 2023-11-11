<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231104003946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, strret VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE person ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_34DCD176F5B7AF75 ON person (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE person DROP CONSTRAINT FK_34DCD176F5B7AF75');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP INDEX IDX_34DCD176F5B7AF75');
        $this->addSql('ALTER TABLE person DROP address_id');
    }
}
