<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726093946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating ADD person_name_id INT NOT NULL, DROP person_name');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262253892F5F FOREIGN KEY (person_name_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_D889262253892F5F ON rating (person_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262253892F5F');
        $this->addSql('DROP INDEX IDX_D889262253892F5F ON rating');
        $this->addSql('ALTER TABLE rating ADD person_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP person_name_id');
    }
}
