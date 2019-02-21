<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218155938 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE birth_dept birth_dept VARCHAR(255) DEFAULT NULL, CHANGE last_medical_visit last_medical_visit DATE DEFAULT NULL, CHANGE social_security_no social_security_no VARCHAR(255) DEFAULT NULL, CHANGE expiry_date_resident expiry_date_resident DATE DEFAULT NULL, CHANGE zip_code_tax zip_code_tax VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE birth_date birth_date VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE birth_dept birth_dept INT DEFAULT NULL, CHANGE last_medical_visit last_medical_visit VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE social_security_no social_security_no INT DEFAULT NULL, CHANGE expiry_date_resident expiry_date_resident VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE zip_code_tax zip_code_tax INT DEFAULT NULL');
    }
}
