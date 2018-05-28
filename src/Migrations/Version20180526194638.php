<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180526194638 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camera ADD manufacturer_id INT NOT NULL');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE05A23B42D FOREIGN KEY (manufacturer_id) REFERENCES cam_manufacturer (id)');
        $this->addSql('CREATE INDEX IDX_3B1CEE05A23B42D ON camera (manufacturer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camera DROP FOREIGN KEY FK_3B1CEE05A23B42D');
        $this->addSql('DROP INDEX IDX_3B1CEE05A23B42D ON camera');
        $this->addSql('ALTER TABLE camera DROP manufacturer_id');
    }
}
