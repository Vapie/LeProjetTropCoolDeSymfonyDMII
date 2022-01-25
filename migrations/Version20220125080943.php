<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125080943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "action" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE chef (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE chef_avis_tempalte (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE etape (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_action_id INTEGER NOT NULL, recette_id INTEGER NOT NULL, etape_index INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_285F75DDB02145DA ON etape (etape_action_id)');
        $this->addSql('CREATE INDEX IDX_285F75DD89312FE9 ON etape (recette_id)');
        $this->addSql('CREATE TABLE etape_ingredient (etape_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(etape_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_5B37942C4A8CA2AD ON etape_ingredient (etape_id)');
        $this->addSql('CREATE INDEX IDX_5B37942C933FE08C ON etape_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, article VARCHAR(255) DEFAULT NULL, mesure VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ingredient_action (ingredient_id INTEGER NOT NULL, action_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, action_id))');
        $this->addSql('CREATE INDEX IDX_ABB64CD3933FE08C ON ingredient_action (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_ABB64CD39D32F035 ON ingredient_action (action_id)');
        $this->addSql('CREATE TABLE recette (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE titre_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "action"');
        $this->addSql('DROP TABLE chef');
        $this->addSql('DROP TABLE chef_avis_tempalte');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE etape_ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_action');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE titre_template');
    }
}
