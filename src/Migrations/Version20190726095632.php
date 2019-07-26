<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726095632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE53892F5F');
        $this->addSql('DROP INDEX UNIQ_E00CEDDE53892F5F ON booking');
        $this->addSql('ALTER TABLE booking DROP person_name_id');
        $this->addSql('ALTER TABLE room CHANGE booking_id booking_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking ADD person_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE53892F5F FOREIGN KEY (person_name_id) REFERENCES person (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDE53892F5F ON booking (person_name_id)');
        $this->addSql('ALTER TABLE room CHANGE booking_id booking_id INT DEFAULT NULL');
    }
}
