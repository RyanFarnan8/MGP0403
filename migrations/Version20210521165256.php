<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521165256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_job_applications ADD tradeperson_id INT DEFAULT NULL, ADD creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381F5B962956 FOREIGN KEY (tradeperson_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381F61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_2F40381F5B962956 ON my_job_applications (tradeperson_id)');
        $this->addSql('CREATE INDEX IDX_2F40381F61220EA6 ON my_job_applications (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381F5B962956');
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381F61220EA6');
        $this->addSql('DROP INDEX IDX_2F40381F5B962956 ON my_job_applications');
        $this->addSql('DROP INDEX IDX_2F40381F61220EA6 ON my_job_applications');
        $this->addSql('ALTER TABLE my_job_applications DROP tradeperson_id, DROP creator_id');
    }
}
