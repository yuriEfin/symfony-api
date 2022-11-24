<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108231935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE balance (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE balance_transaction (id INT AUTO_INCREMENT NOT NULL, balance_id INT DEFAULT NULL, sum DOUBLE PRECISION NOT NULL, type VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_A70FE733AE91A3DD (balance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, title VARCHAR(155) NOT NULL, slug VARCHAR(200) NOT NULL, parse_url VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3AF34668989D9B62 (slug), INDEX IDX_3AF346686BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_categories (categories_source INT NOT NULL, categories_target INT NOT NULL, INDEX IDX_9B7D066057E3414B (categories_source), INDEX IDX_9B7D06604E0611C4 (categories_target), PRIMARY KEY(categories_source, categories_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, alias VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE balance_transaction ADD CONSTRAINT FK_A70FE733AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346686BF700BD FOREIGN KEY (status_id) REFERENCES categories_status (id)');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D066057E3414B FOREIGN KEY (categories_source) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D06604E0611C4 FOREIGN KEY (categories_target) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balance_transaction DROP FOREIGN KEY FK_A70FE733AE91A3DD');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346686BF700BD');
        $this->addSql('ALTER TABLE categories_categories DROP FOREIGN KEY FK_9B7D066057E3414B');
        $this->addSql('ALTER TABLE categories_categories DROP FOREIGN KEY FK_9B7D06604E0611C4');
        $this->addSql('DROP TABLE balance');
        $this->addSql('DROP TABLE balance_transaction');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_categories');
        $this->addSql('DROP TABLE categories_status');
    }
}
