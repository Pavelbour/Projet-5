<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180712070746 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camera ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE0559027487 FOREIGN KEY (theme_id) REFERENCES forum_theme (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B1CEE0559027487 ON camera (theme_id)');
        $this->addSql('ALTER TABLE cam_manufacturer ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE cam_manufacturer ADD CONSTRAINT FK_54F5D1AE59027487 FOREIGN KEY (theme_id) REFERENCES forum_theme (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54F5D1AE59027487 ON cam_manufacturer (theme_id)');
        $this->addSql('ALTER TABLE lens ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE lens ADD CONSTRAINT FK_2CDAF8C359027487 FOREIGN KEY (theme_id) REFERENCES forum_theme (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CDAF8C359027487 ON lens (theme_id)');
        $this->addSql('ALTER TABLE lens_manufacturer ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE lens_manufacturer ADD CONSTRAINT FK_3D6C978C59027487 FOREIGN KEY (theme_id) REFERENCES forum_theme (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D6C978C59027487 ON lens_manufacturer (theme_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cam_manufacturer DROP FOREIGN KEY FK_54F5D1AE59027487');
        $this->addSql('DROP INDEX UNIQ_54F5D1AE59027487 ON cam_manufacturer');
        $this->addSql('ALTER TABLE cam_manufacturer DROP theme_id');
        $this->addSql('ALTER TABLE camera DROP FOREIGN KEY FK_3B1CEE0559027487');
        $this->addSql('DROP INDEX UNIQ_3B1CEE0559027487 ON camera');
        $this->addSql('ALTER TABLE camera DROP theme_id');
        $this->addSql('ALTER TABLE lens DROP FOREIGN KEY FK_2CDAF8C359027487');
        $this->addSql('DROP INDEX UNIQ_2CDAF8C359027487 ON lens');
        $this->addSql('ALTER TABLE lens DROP theme_id');
        $this->addSql('ALTER TABLE lens_manufacturer DROP FOREIGN KEY FK_3D6C978C59027487');
        $this->addSql('DROP INDEX UNIQ_3D6C978C59027487 ON lens_manufacturer');
        $this->addSql('ALTER TABLE lens_manufacturer DROP theme_id');
    }
}
