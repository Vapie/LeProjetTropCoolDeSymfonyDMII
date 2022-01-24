<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124125957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "action" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE action_ingredient_type (action_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(action_id, ingredient_type_id))');
        $this->addSql('CREATE INDEX IDX_B19DB1C89D32F035 ON action_ingredient_type (action_id)');
        $this->addSql('CREATE INDEX IDX_B19DB1C8C47B8755 ON action_ingredient_type (ingredient_type_id)');
        $this->addSql('CREATE TABLE ingredient_ingredient_type (ingredient_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, ingredient_type_id))');
        $this->addSql('CREATE INDEX IDX_485EE350933FE08C ON ingredient_ingredient_type (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_485EE350C47B8755 ON ingredient_ingredient_type (ingredient_type_id)');
        $this->addSql('CREATE TABLE ingredient_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "action"');
        $this->addSql('DROP TABLE action_ingredient_type');
        $this->addSql('DROP TABLE ingredient_ingredient_type');
        $this->addSql('DROP TABLE ingredient_type');
    }
}
