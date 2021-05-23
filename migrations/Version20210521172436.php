<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521172436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381F5B962956');
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381FBE04EA9');
        $this->addSql('DROP INDEX IDX_2F40381F5B962956 ON my_job_applications');
        $this->addSql('DROP INDEX IDX_2F40381FBE04EA9 ON my_job_applications');
        $this->addSql('ALTER TABLE my_job_applications ADD trade_id INT DEFAULT NULL, ADD county_id INT DEFAULT NULL, ADD contact VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD location VARCHAR(255) NOT NULL, DROP job_id, DROP tradeperson_id');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381FC2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id)');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381F85E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('CREATE INDEX IDX_2F40381FC2D9760 ON my_job_applications (trade_id)');
        $this->addSql('CREATE INDEX IDX_2F40381F85E73F45 ON my_job_applications (county_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381FC2D9760');
        $this->addSql('ALTER TABLE my_job_applications DROP FOREIGN KEY FK_2F40381F85E73F45');
        $this->addSql('DROP INDEX IDX_2F40381FC2D9760 ON my_job_applications');
        $this->addSql('DROP INDEX IDX_2F40381F85E73F45 ON my_job_applications');
        $this->addSql('ALTER TABLE my_job_applications ADD job_id INT DEFAULT NULL, ADD tradeperson_id INT DEFAULT NULL, DROP trade_id, DROP county_id, DROP contact, DROP description, DROP location');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381F5B962956 FOREIGN KEY (tradeperson_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE my_job_applications ADD CONSTRAINT FK_2F40381FBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_2F40381F5B962956 ON my_job_applications (tradeperson_id)');
        $this->addSql('CREATE INDEX IDX_2F40381FBE04EA9 ON my_job_applications (job_id)');
    }
}
