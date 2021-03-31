<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330165620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD timeslots_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F83E5EC740 FOREIGN KEY (timeslots_id) REFERENCES timeslots (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F83E5EC740 ON job (timeslots_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F83E5EC740');
        $this->addSql('DROP INDEX IDX_FBD8E0F83E5EC740 ON job');
        $this->addSql('ALTER TABLE job DROP timeslots_id');
    }
}
