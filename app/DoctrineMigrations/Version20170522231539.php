<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170522231539 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, document_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attraction_documents (id INT AUTO_INCREMENT NOT NULL, attraction_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, document_path VARCHAR(255) NOT NULL, INDEX IDX_4C55CB383C216F9D (attraction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attractions (id INT AUTO_INCREMENT NOT NULL, reservation_number VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, costs DOUBLE PRECISION NOT NULL, starts_at DATETIME NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, reservation_number VARCHAR(255) NOT NULL, transport_reference VARCHAR(255) NOT NULL, transporter VARCHAR(255) NOT NULL, means_of_transport VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, depart_at DATETIME NOT NULL, arrive_at DATETIME NOT NULL, costs DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attraction_transport (id INT AUTO_INCREMENT NOT NULL, attraction_id INT DEFAULT NULL, reservation_number VARCHAR(255) NOT NULL, transport_reference VARCHAR(255) NOT NULL, transporter VARCHAR(255) NOT NULL, means_of_transport VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, depart_at DATETIME NOT NULL, arrive_at DATETIME NOT NULL, costs DOUBLE PRECISION NOT NULL, INDEX IDX_884E989E3C216F9D (attraction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_documents (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, document_path VARCHAR(255) NOT NULL, INDEX IDX_1CF9034A3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotels (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, reservation_number VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, arrive_at DATETIME NOT NULL, depart_at DATETIME NOT NULL, costs DOUBLE PRECISION NOT NULL, is_reserved_with_credit_card TINYINT(1) NOT NULL, is_charged TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel_transport (id INT AUTO_INCREMENT NOT NULL, reservation_number VARCHAR(255) NOT NULL, transport_reference VARCHAR(255) NOT NULL, transporter VARCHAR(255) NOT NULL, means_of_transport VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, depart_at DATETIME NOT NULL, arrive_at DATETIME NOT NULL, costs DOUBLE PRECISION NOT NULL, hotel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prepayments (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, costs DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prepayments_documents (id INT AUTO_INCREMENT NOT NULL, prepayment_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, document_path VARCHAR(255) NOT NULL, INDEX IDX_8840561BB3BD4DA (prepayment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport_documents (id INT AUTO_INCREMENT NOT NULL, transport_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, document_path VARCHAR(255) NOT NULL, INDEX IDX_3473F4139909C13F (transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attraction_documents ADD CONSTRAINT FK_4C55CB383C216F9D FOREIGN KEY (attraction_id) REFERENCES attractions (id)');
        $this->addSql('ALTER TABLE attraction_transport ADD CONSTRAINT FK_884E989E3C216F9D FOREIGN KEY (attraction_id) REFERENCES attractions (id)');
        $this->addSql('ALTER TABLE hotel_documents ADD CONSTRAINT FK_1CF9034A3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotels (id)');
        $this->addSql('ALTER TABLE prepayments_documents ADD CONSTRAINT FK_8840561BB3BD4DA FOREIGN KEY (prepayment_id) REFERENCES prepayments (id)');
        $this->addSql('ALTER TABLE transport_documents ADD CONSTRAINT FK_3473F4139909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE attraction_documents DROP FOREIGN KEY FK_4C55CB383C216F9D');
        $this->addSql('ALTER TABLE attraction_transport DROP FOREIGN KEY FK_884E989E3C216F9D');
        $this->addSql('ALTER TABLE transport_documents DROP FOREIGN KEY FK_3473F4139909C13F');
        $this->addSql('ALTER TABLE hotel_documents DROP FOREIGN KEY FK_1CF9034A3243BB18');
        $this->addSql('ALTER TABLE prepayments_documents DROP FOREIGN KEY FK_8840561BB3BD4DA');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE attraction_documents');
        $this->addSql('DROP TABLE attractions');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE attraction_transport');
        $this->addSql('DROP TABLE hotel_documents');
        $this->addSql('DROP TABLE hotels');
        $this->addSql('DROP TABLE hotel_transport');
        $this->addSql('DROP TABLE prepayments');
        $this->addSql('DROP TABLE prepayments_documents');
        $this->addSql('DROP TABLE transport_documents');
    }
}
