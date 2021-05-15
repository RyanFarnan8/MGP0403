<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512175452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE county (id INT AUTO_INCREMENT NOT NULL, county VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, trade_id INT DEFAULT NULL, county_id INT DEFAULT NULL, contact VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_FBD8E0F861220EA6 (creator_id), INDEX IDX_FBD8E0F8C2D9760 (trade_id), INDEX IDX_FBD8E0F885E73F45 (county_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_application (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, tradeperson_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_C737C688BE04EA9 (job_id), INDEX IDX_C737C6885B962956 (tradeperson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_assigned (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, trade_id INT DEFAULT NULL, county_id INT DEFAULT NULL, trade_person_id INT DEFAULT NULL, contact VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_6CDD69E161220EA6 (creator_id), INDEX IDX_6CDD69E1C2D9760 (trade_id), INDEX IDX_6CDD69E185E73F45 (county_id), INDEX IDX_6CDD69E162DD73A (trade_person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_completed (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_FD48B37F61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trade (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, trade_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, contact_number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649C2D9760 (trade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F861220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F885E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C688BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job_application ADD CONSTRAINT FK_C737C6885B962956 FOREIGN KEY (tradeperson_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E161220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E1C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E185E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E162DD73A FOREIGN KEY (trade_person_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job_completed ADD CONSTRAINT FK_FD48B37F61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F885E73F45');
        $this->addSql('ALTER TABLE job_assigned DROP FOREIGN KEY FK_6CDD69E185E73F45');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C688BE04EA9');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8C2D9760');
        $this->addSql('ALTER TABLE job_assigned DROP FOREIGN KEY FK_6CDD69E1C2D9760');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C2D9760');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F861220EA6');
        $this->addSql('ALTER TABLE job_application DROP FOREIGN KEY FK_C737C6885B962956');
        $this->addSql('ALTER TABLE job_assigned DROP FOREIGN KEY FK_6CDD69E161220EA6');
        $this->addSql('ALTER TABLE job_assigned DROP FOREIGN KEY FK_6CDD69E162DD73A');
        $this->addSql('ALTER TABLE job_completed DROP FOREIGN KEY FK_FD48B37F61220EA6');
        $this->addSql('DROP TABLE county');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_application');
        $this->addSql('DROP TABLE job_assigned');
        $this->addSql('DROP TABLE job_completed');
        $this->addSql('DROP TABLE trade');
        $this->addSql('DROP TABLE `user`');
    }
}
