<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241010183002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kakebo (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, year_month_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', objectif_reduction LONGTEXT DEFAULT NULL, objectif_undertake LONGTEXT DEFAULT NULL, save_money DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_5F5E0CE2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kakebo ADD CONSTRAINT FK_5F5E0CE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kakebo DROP FOREIGN KEY FK_5F5E0CE2A76ED395');
        $this->addSql('DROP TABLE kakebo');
    }
}
