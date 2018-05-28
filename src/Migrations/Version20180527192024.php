<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180527192024 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lens_cam_manufacturer (lens_id INT NOT NULL, cam_manufacturer_id INT NOT NULL, INDEX IDX_F96C104A4FCBBD7A (lens_id), INDEX IDX_F96C104AE05347C3 (cam_manufacturer_id), PRIMARY KEY(lens_id, cam_manufacturer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lens_cam_manufacturer ADD CONSTRAINT FK_F96C104A4FCBBD7A FOREIGN KEY (lens_id) REFERENCES lens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lens_cam_manufacturer ADD CONSTRAINT FK_F96C104AE05347C3 FOREIGN KEY (cam_manufacturer_id) REFERENCES cam_manufacturer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lens ADD manufacturer_id INT NOT NULL, ADD monture_id INT NOT NULL');
        $this->addSql('ALTER TABLE lens ADD CONSTRAINT FK_2CDAF8C3A23B42D FOREIGN KEY (manufacturer_id) REFERENCES lens_manufacturer (id)');
        $this->addSql('ALTER TABLE lens ADD CONSTRAINT FK_2CDAF8C3D40ADBBC FOREIGN KEY (monture_id) REFERENCES monture (id)');
        $this->addSql('CREATE INDEX IDX_2CDAF8C3A23B42D ON lens (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_2CDAF8C3D40ADBBC ON lens (monture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lens_cam_manufacturer');
        $this->addSql('ALTER TABLE lens DROP FOREIGN KEY FK_2CDAF8C3A23B42D');
        $this->addSql('ALTER TABLE lens DROP FOREIGN KEY FK_2CDAF8C3D40ADBBC');
        $this->addSql('DROP INDEX IDX_2CDAF8C3A23B42D ON lens');
        $this->addSql('DROP INDEX IDX_2CDAF8C3D40ADBBC ON lens');
        $this->addSql('ALTER TABLE lens DROP manufacturer_id, DROP monture_id');
    }
}
