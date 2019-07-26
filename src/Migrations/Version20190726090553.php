<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726090553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hotel ADD room_capacity_id INT DEFAULT NULL, DROP hotel_capacity');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED972835E85 FOREIGN KEY (room_capacity_id) REFERENCES room (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED972835E85 ON hotel (room_capacity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED972835E85');
        $this->addSql('DROP INDEX UNIQ_3535ED972835E85 ON hotel');
        $this->addSql('ALTER TABLE hotel ADD hotel_capacity INT NOT NULL, DROP room_capacity_id');
    }
}
