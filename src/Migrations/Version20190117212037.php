<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117212037 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE artist_project');
        $this->addSql('DROP TABLE participant');
        $this->addSql('ALTER TABLE artist ADD rib_name VARCHAR(255) DEFAULT NULL, ADD rib_size INT DEFAULT NULL, ADD updated_at5 DATETIME DEFAULT NULL, ADD social_card_name VARCHAR(255) DEFAULT NULL, ADD social_card_size INT DEFAULT NULL, ADD updated_at6 DATETIME DEFAULT NULL, ADD identity_card_name VARCHAR(255) DEFAULT NULL, ADD identity_card_size INT DEFAULT NULL, ADD updated_at7 DATETIME DEFAULT NULL, ADD residence_permit_name VARCHAR(255) DEFAULT NULL, ADD residence_permit_size INT DEFAULT NULL, ADD updated_at8 DATETIME DEFAULT NULL, ADD cmb_name VARCHAR(255) DEFAULT NULL, ADD cmb_size INT DEFAULT NULL, ADD updated_at9 DATETIME DEFAULT NULL, CHANGE document_name cv_name VARCHAR(255) DEFAULT NULL, CHANGE document_size cv_size INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist_project (artist_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_98FC8ED9B7970CF8 (artist_id), INDEX IDX_98FC8ED9166D1F9C (project_id), PRIMARY KEY(artist_id, project_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_D79F6B11B7970CF8 (artist_id), INDEX IDX_D79F6B11166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_project ADD CONSTRAINT FK_98FC8ED9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_project ADD CONSTRAINT FK_98FC8ED9B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE artist ADD document_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD document_size INT DEFAULT NULL, DROP cv_name, DROP cv_size, DROP rib_name, DROP rib_size, DROP updated_at5, DROP social_card_name, DROP social_card_size, DROP updated_at6, DROP identity_card_name, DROP identity_card_size, DROP updated_at7, DROP residence_permit_name, DROP residence_permit_size, DROP updated_at8, DROP cmb_name, DROP cmb_size, DROP updated_at9');
    }
}
