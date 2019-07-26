<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726101022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room CHANGE booking_id booking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD hotel_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A25D82FF FOREIGN KEY (hotel_name_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_D8892622A25D82FF ON rating (hotel_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A25D82FF');
        $this->addSql('DROP INDEX IDX_D8892622A25D82FF ON rating');
        $this->addSql('ALTER TABLE rating DROP hotel_name_id');
        $this->addSql('ALTER TABLE room CHANGE booking_id booking_id INT DEFAULT NULL');
    }
}
