<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412143719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8F920B9E9');
        $this->addSql('CREATE TABLE job_completed (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_FD48B37F61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_completed ADD CONSTRAINT FK_FD48B37F61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('DROP TABLE timeslot');
        $this->addSql('DROP INDEX IDX_FBD8E0F8F920B9E9 ON job');
        $this->addSql('ALTER TABLE job DROP timeslot_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE job_completed');
        $this->addSql('ALTER TABLE job ADD timeslot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8F920B9E9 FOREIGN KEY (timeslot_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8F920B9E9 ON job (timeslot_id)');
    }
}
