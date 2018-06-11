<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180608075532 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lens_comment (id INT AUTO_INCREMENT NOT NULL, lens_id_id INT NOT NULL, user_id_id INT NOT NULL, comment LONGTEXT NOT NULL, added DATETIME NOT NULL, INDEX IDX_F4107A3762FAE334 (lens_id_id), INDEX IDX_F4107A379D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lens_comment ADD CONSTRAINT FK_F4107A3762FAE334 FOREIGN KEY (lens_id_id) REFERENCES lens (id)');
        $this->addSql('ALTER TABLE lens_comment ADD CONSTRAINT FK_F4107A379D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE camera_comment CHANGE added added DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lens_comment');
        $this->addSql('ALTER TABLE camera_comment CHANGE added added DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
