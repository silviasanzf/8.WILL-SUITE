<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217165329 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE birth_date birth_date VARCHAR(255) DEFAULT NULL, CHANGE home_phone home_phone VARCHAR(255) DEFAULT NULL, CHANGE last_medical_visit last_medical_visit VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE show_no show_no VARCHAR(255) DEFAULT NULL, CHANGE zip_code zip_code VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE last_medical_visit last_medical_visit DATE DEFAULT NULL, CHANGE show_no show_no INT DEFAULT NULL, CHANGE zip_code zip_code INT DEFAULT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE home_phone home_phone INT DEFAULT NULL');
    }
}
