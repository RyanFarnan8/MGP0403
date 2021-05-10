<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510142035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_assigned (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, trade_id INT DEFAULT NULL, county_id INT DEFAULT NULL, trade_person_id INT DEFAULT NULL, contact VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_6CDD69E161220EA6 (creator_id), INDEX IDX_6CDD69E1C2D9760 (trade_id), INDEX IDX_6CDD69E185E73F45 (county_id), INDEX IDX_6CDD69E162DD73A (trade_person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E161220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E1C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E185E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('ALTER TABLE job_assigned ADD CONSTRAINT FK_6CDD69E162DD73A FOREIGN KEY (trade_person_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE job_assigned');
    }
}
