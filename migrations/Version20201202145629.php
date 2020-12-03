<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202145629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza ADD basepizza_id INT NOT NULL');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826F9453455B FOREIGN KEY (basepizza_id) REFERENCES base_pizza (id)');
        $this->addSql('CREATE INDEX IDX_CFDD826F9453455B ON pizza (basepizza_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826F9453455B');
        $this->addSql('DROP INDEX IDX_CFDD826F9453455B ON pizza');
        $this->addSql('ALTER TABLE pizza DROP basepizza_id');
    }
}
