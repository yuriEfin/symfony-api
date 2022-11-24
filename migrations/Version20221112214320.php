<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112214320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
    
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE balance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE balance_transaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomanclature_atribute_value_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomanclature_atributes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_attribute_options_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE balance (id INT NOT NULL, user_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE balance_transaction (id INT NOT NULL, balance_id INT DEFAULT NULL, sum DOUBLE PRECISION NOT NULL, type VARCHAR(30) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A70FE733AE91A3DD ON balance_transaction (balance_id)');
        $this->addSql('CREATE TABLE categories (id INT NOT NULL, status_id INT DEFAULT NULL, title VARCHAR(155) NOT NULL, slug VARCHAR(200) NOT NULL, parse_url VARCHAR(1000) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF34668989D9B62 ON categories (slug)');
        $this->addSql('CREATE INDEX IDX_3AF346686BF700BD ON categories (status_id)');
        $this->addSql('CREATE TABLE categories_categories (categories_source INT NOT NULL, categories_target INT NOT NULL, PRIMARY KEY(categories_source, categories_target))');
        $this->addSql('CREATE INDEX IDX_9B7D066057E3414B ON categories_categories (categories_source)');
        $this->addSql('CREATE INDEX IDX_9B7D06604E0611C4 ON categories_categories (categories_target)');
        $this->addSql('CREATE TABLE categories_status (id INT NOT NULL, title VARCHAR(100) NOT NULL, alias VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO categories_status (id, title, alias, created_at) VALUES (1,\'Опубликован\',\'published\', NOW())');
        $this->addSql('INSERT INTO categories_status (id, title, alias, created_at) VALUES (10,\'Черновик\',\'dirty\', NOW())');
        
        $this->addSql('COMMENT ON COLUMN categories_status.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE nomanclature_atribute_value (id INT NOT NULL, attribute_id INT NOT NULL, attribute_value TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nomanclature_atributes (id INT NOT NULL, nomenclature_group_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(300) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FE4F4CBA807DA56 ON nomanclature_atributes (nomenclature_group_id)');
        $this->addSql('CREATE TABLE nomenclature (id INT NOT NULL, title VARCHAR(300) NOT NULL, price DOUBLE PRECISION NOT NULL, external_price DOUBLE PRECISION DEFAULT NULL, default_tax INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nomenclature_attribute_options (id INT NOT NULL, title VARCHAR(255) NOT NULL, nomenclature_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nomenclature_group (id INT NOT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(300) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE balance_transaction ADD CONSTRAINT FK_A70FE733AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346686BF700BD FOREIGN KEY (status_id) REFERENCES categories_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D066057E3414B FOREIGN KEY (categories_source) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_categories ADD CONSTRAINT FK_9B7D06604E0611C4 FOREIGN KEY (categories_target) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nomanclature_atributes ADD CONSTRAINT FK_6FE4F4CBA807DA56 FOREIGN KEY (nomenclature_group_id) REFERENCES nomenclature_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
    
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE balance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE balance_transaction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomanclature_atribute_value_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomanclature_atributes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_attribute_options_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_group_id_seq CASCADE');
        $this->addSql('ALTER TABLE balance_transaction DROP CONSTRAINT FK_A70FE733AE91A3DD');
        $this->addSql('ALTER TABLE categories DROP CONSTRAINT FK_3AF346686BF700BD');
        $this->addSql('ALTER TABLE categories_categories DROP CONSTRAINT FK_9B7D066057E3414B');
        $this->addSql('ALTER TABLE categories_categories DROP CONSTRAINT FK_9B7D06604E0611C4');
        $this->addSql('ALTER TABLE nomanclature_atributes DROP CONSTRAINT FK_6FE4F4CBA807DA56');
        $this->addSql('DROP TABLE balance');
        $this->addSql('DROP TABLE balance_transaction');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_categories');
        $this->addSql('DROP TABLE categories_status');
        $this->addSql('DROP TABLE nomanclature_atribute_value');
        $this->addSql('DROP TABLE nomanclature_atributes');
        $this->addSql('DROP TABLE nomenclature');
        $this->addSql('DROP TABLE nomenclature_attribute_options');
        $this->addSql('DROP TABLE nomenclature_group');
    }
}
