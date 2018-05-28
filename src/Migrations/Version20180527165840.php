<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180527165840 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE camera_monture (camera_id INT NOT NULL, monture_id INT NOT NULL, INDEX IDX_F3C9EC0FB47685CD (camera_id), INDEX IDX_F3C9EC0FD40ADBBC (monture_id), PRIMARY KEY(camera_id, monture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE camera_monture ADD CONSTRAINT FK_F3C9EC0FB47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camera_monture ADD CONSTRAINT FK_F3C9EC0FD40ADBBC FOREIGN KEY (monture_id) REFERENCES monture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camera DROP monture');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE camera_monture');
        $this->addSql('ALTER TABLE camera ADD monture VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
