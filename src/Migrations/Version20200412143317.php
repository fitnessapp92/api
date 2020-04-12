<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200412143317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE difficulty_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, difficulty_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workout ADD difficulty_level_id INT NOT NULL');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB7264890943 FOREIGN KEY (difficulty_level_id) REFERENCES difficulty_level (id)');
        $this->addSql('CREATE INDEX IDX_649FFB7264890943 ON workout (difficulty_level_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB7264890943');
        $this->addSql('DROP TABLE difficulty_level');
        $this->addSql('DROP INDEX IDX_649FFB7264890943 ON workout');
        $this->addSql('ALTER TABLE workout DROP difficulty_level_id');
    }
}
