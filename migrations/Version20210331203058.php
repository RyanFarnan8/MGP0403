<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331203058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE county (id INT AUTO_INCREMENT NOT NULL, county VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, trade_id INT DEFAULT NULL, time_slot_id INT DEFAULT NULL, timeslots_id INT DEFAULT NULL, county_id INT DEFAULT NULL, contact VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_FBD8E0F861220EA6 (creator_id), INDEX IDX_FBD8E0F8C2D9760 (trade_id), INDEX IDX_FBD8E0F8D62B0FA (time_slot_id), INDEX IDX_FBD8E0F83E5EC740 (timeslots_id), INDEX IDX_FBD8E0F885E73F45 (county_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeslots (id INT AUTO_INCREMENT NOT NULL, timeslots VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F861220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8D62B0FA FOREIGN KEY (time_slot_id) REFERENCES timeslots (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F83E5EC740 FOREIGN KEY (timeslots_id) REFERENCES timeslots (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F885E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F885E73F45');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8D62B0FA');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F83E5EC740');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8C2D9760');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F861220EA6');
        $this->addSql('DROP TABLE county');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE timeslots');
        $this->addSql('DROP TABLE trade');
        $this->addSql('DROP TABLE `user`');
    }
}
