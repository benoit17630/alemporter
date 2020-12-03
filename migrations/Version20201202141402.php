<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202141402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pizza (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_meat (pizza_id INT NOT NULL, meat_id INT NOT NULL, INDEX IDX_45BE951FD41D1D42 (pizza_id), INDEX IDX_45BE951FF63B19A6 (meat_id), PRIMARY KEY(pizza_id, meat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_fish (pizza_id INT NOT NULL, fish_id INT NOT NULL, INDEX IDX_F750C7E6D41D1D42 (pizza_id), INDEX IDX_F750C7E68311A1E2 (fish_id), PRIMARY KEY(pizza_id, fish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_legume (pizza_id INT NOT NULL, legume_id INT NOT NULL, INDEX IDX_E985867D41D1D42 (pizza_id), INDEX IDX_E98586725F18E37 (legume_id), PRIMARY KEY(pizza_id, legume_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_cheese (pizza_id INT NOT NULL, cheese_id INT NOT NULL, INDEX IDX_65307A27D41D1D42 (pizza_id), INDEX IDX_65307A272AD46E66 (cheese_id), PRIMARY KEY(pizza_id, cheese_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_other (pizza_id INT NOT NULL, other_id INT NOT NULL, INDEX IDX_2F2937F8D41D1D42 (pizza_id), INDEX IDX_2F2937F8998D9879 (other_id), PRIMARY KEY(pizza_id, other_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza_meat ADD CONSTRAINT FK_45BE951FD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_meat ADD CONSTRAINT FK_45BE951FF63B19A6 FOREIGN KEY (meat_id) REFERENCES meat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_fish ADD CONSTRAINT FK_F750C7E6D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_fish ADD CONSTRAINT FK_F750C7E68311A1E2 FOREIGN KEY (fish_id) REFERENCES fish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_legume ADD CONSTRAINT FK_E985867D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_legume ADD CONSTRAINT FK_E98586725F18E37 FOREIGN KEY (legume_id) REFERENCES legume (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_cheese ADD CONSTRAINT FK_65307A27D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_cheese ADD CONSTRAINT FK_65307A272AD46E66 FOREIGN KEY (cheese_id) REFERENCES cheese (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_other ADD CONSTRAINT FK_2F2937F8D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_other ADD CONSTRAINT FK_2F2937F8998D9879 FOREIGN KEY (other_id) REFERENCES other (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_meat DROP FOREIGN KEY FK_45BE951FD41D1D42');
        $this->addSql('ALTER TABLE pizza_fish DROP FOREIGN KEY FK_F750C7E6D41D1D42');
        $this->addSql('ALTER TABLE pizza_legume DROP FOREIGN KEY FK_E985867D41D1D42');
        $this->addSql('ALTER TABLE pizza_cheese DROP FOREIGN KEY FK_65307A27D41D1D42');
        $this->addSql('ALTER TABLE pizza_other DROP FOREIGN KEY FK_2F2937F8D41D1D42');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_meat');
        $this->addSql('DROP TABLE pizza_fish');
        $this->addSql('DROP TABLE pizza_legume');
        $this->addSql('DROP TABLE pizza_cheese');
        $this->addSql('DROP TABLE pizza_other');
    }
}
