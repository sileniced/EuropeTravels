<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170522231748 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documents CHANGE name description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE attraction_documents CHANGE name description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE transport CHANGE transport_reference transport_reference VARCHAR(255) DEFAULT NULL, CHANGE transporter transporter VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE attraction_transport CHANGE transport_reference transport_reference VARCHAR(255) DEFAULT NULL, CHANGE transporter transporter VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel_documents CHANGE name description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE hotels CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE reservation_number reservation_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel_transport CHANGE transport_reference transport_reference VARCHAR(255) DEFAULT NULL, CHANGE transporter transporter VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE prepayments_documents CHANGE name description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE transport_documents CHANGE name description VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attraction_documents CHANGE description name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE attraction_transport CHANGE transport_reference transport_reference VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE transporter transporter VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE documents CHANGE description name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE hotel_documents CHANGE description name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE hotel_transport CHANGE transport_reference transport_reference VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE transporter transporter VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE hotels CHANGE name name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE reservation_number reservation_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE prepayments_documents CHANGE description name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE transport CHANGE transport_reference transport_reference VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE transporter transporter VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE transport_documents CHANGE description name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
