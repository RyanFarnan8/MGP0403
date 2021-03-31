<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330165149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD time_slot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8D62B0FA FOREIGN KEY (time_slot_id) REFERENCES timeslots (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8D62B0FA ON job (time_slot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8D62B0FA');
        $this->addSql('DROP INDEX IDX_FBD8E0F8D62B0FA ON job');
        $this->addSql('ALTER TABLE job DROP time_slot_id');
    }
}
