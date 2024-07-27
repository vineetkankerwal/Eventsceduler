<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240713064516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_details ADD email_id INT NOT NULL');
        $this->addSql('ALTER TABLE event_details ADD CONSTRAINT FK_F771A225A832C1C9 FOREIGN KEY (email_id) REFERENCES user_register (id)');
        $this->addSql('CREATE INDEX IDX_F771A225A832C1C9 ON event_details (email_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_details DROP FOREIGN KEY FK_F771A225A832C1C9');
        $this->addSql('DROP INDEX IDX_F771A225A832C1C9 ON event_details');
        $this->addSql('ALTER TABLE event_details DROP email_id');
    }
}
