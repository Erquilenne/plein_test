<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005104144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_elements (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, barcode VARCHAR(15) NOT NULL, price DOUBLE PRECISION NOT NULL, cost DOUBLE PRECISION NOT NULL, tax_perc INT NOT NULL, tax_amt DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, tracking_number VARCHAR(20) NOT NULL, canceled VARCHAR(3) NOT NULL, shipped_status_sku VARCHAR(10) NOT NULL, INDEX IDX_A5B2E5ECFCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_id VARCHAR(15) NOT NULL, phone VARCHAR(15) NOT NULL, shipping_status VARCHAR(20) NOT NULL, shipping_price DOUBLE PRECISION NOT NULL, shipping_payment_status VARCHAR(20) NOT NULL, payment_status VARCHAR(20) NOT NULL, currency VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_E52FFDEE8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_elements ADD CONSTRAINT FK_A5B2E5ECFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_elements DROP FOREIGN KEY FK_A5B2E5ECFCDAEAAA');
        $this->addSql('DROP TABLE order_elements');
        $this->addSql('DROP TABLE orders');
    }
}
