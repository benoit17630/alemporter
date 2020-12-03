<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202150831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_pizza DROP FOREIGN KEY FK_72F613BD1B84D535');
        $this->addSql('DROP INDEX IDX_72F613BD1B84D535 ON base_pizza');
        $this->addSql('ALTER TABLE base_pizza DROP base_ingredient_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_pizza ADD base_ingredient_id INT NOT NULL');
        $this->addSql('ALTER TABLE base_pizza ADD CONSTRAINT FK_72F613BD1B84D535 FOREIGN KEY (base_ingredient_id) REFERENCES base_ingredient (id)');
        $this->addSql('CREATE INDEX IDX_72F613BD1B84D535 ON base_pizza (base_ingredient_id)');
    }
}
