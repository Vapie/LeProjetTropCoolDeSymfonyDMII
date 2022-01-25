<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125095053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chef (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE chef_avis_tempalte (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ingredient_action (ingredient_id INTEGER NOT NULL, action_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, action_id))');
        $this->addSql('CREATE INDEX IDX_ABB64CD3933FE08C ON ingredient_action (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_ABB64CD39D32F035 ON ingredient_action (action_id)');
        $this->addSql('CREATE TABLE titre_template (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP TABLE ingredient_ingredient_type');
        $this->addSql('DROP TABLE ingredient_type');
        $this->addSql('DROP INDEX IDX_285F75DD89312FE9');
        $this->addSql('DROP INDEX IDX_285F75DDB02145DA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__etape AS SELECT id, etape_action_id, recette_id, etape_index FROM etape');
        $this->addSql('DROP TABLE etape');
        $this->addSql('CREATE TABLE etape (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_action_id INTEGER NOT NULL, recette_id INTEGER NOT NULL, etape_index INTEGER NOT NULL, CONSTRAINT FK_285F75DDB02145DA FOREIGN KEY (etape_action_id) REFERENCES "action" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_285F75DD89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO etape (id, etape_action_id, recette_id, etape_index) SELECT id, etape_action_id, recette_id, etape_index FROM __temp__etape');
        $this->addSql('DROP TABLE __temp__etape');
        $this->addSql('CREATE INDEX IDX_285F75DD89312FE9 ON etape (recette_id)');
        $this->addSql('CREATE INDEX IDX_285F75DDB02145DA ON etape (etape_action_id)');
        $this->addSql('DROP INDEX IDX_5B37942C933FE08C');
        $this->addSql('DROP INDEX IDX_5B37942C4A8CA2AD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__etape_ingredient AS SELECT etape_id, ingredient_id FROM etape_ingredient');
        $this->addSql('DROP TABLE etape_ingredient');
        $this->addSql('CREATE TABLE etape_ingredient (etape_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(etape_id, ingredient_id), CONSTRAINT FK_5B37942C4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5B37942C933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO etape_ingredient (etape_id, ingredient_id) SELECT etape_id, ingredient_id FROM __temp__etape_ingredient');
        $this->addSql('DROP TABLE __temp__etape_ingredient');
        $this->addSql('CREATE INDEX IDX_5B37942C933FE08C ON etape_ingredient (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_5B37942C4A8CA2AD ON etape_ingredient (etape_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_ingredient_type (ingredient_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, ingredient_type_id))');
        $this->addSql('CREATE INDEX IDX_485EE350933FE08C ON ingredient_ingredient_type (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_485EE350C47B8755 ON ingredient_ingredient_type (ingredient_type_id)');
        $this->addSql('CREATE TABLE ingredient_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('DROP TABLE chef');
        $this->addSql('DROP TABLE chef_avis_tempalte');
        $this->addSql('DROP TABLE ingredient_action');
        $this->addSql('DROP TABLE titre_template');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_285F75DDB02145DA');
        $this->addSql('DROP INDEX IDX_285F75DD89312FE9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__etape AS SELECT id, etape_action_id, recette_id, etape_index FROM etape');
        $this->addSql('DROP TABLE etape');
        $this->addSql('CREATE TABLE etape (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_action_id INTEGER NOT NULL, recette_id INTEGER NOT NULL, etape_index INTEGER NOT NULL)');
        $this->addSql('INSERT INTO etape (id, etape_action_id, recette_id, etape_index) SELECT id, etape_action_id, recette_id, etape_index FROM __temp__etape');
        $this->addSql('DROP TABLE __temp__etape');
        $this->addSql('CREATE INDEX IDX_285F75DDB02145DA ON etape (etape_action_id)');
        $this->addSql('CREATE INDEX IDX_285F75DD89312FE9 ON etape (recette_id)');
        $this->addSql('DROP INDEX IDX_5B37942C4A8CA2AD');
        $this->addSql('DROP INDEX IDX_5B37942C933FE08C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__etape_ingredient AS SELECT etape_id, ingredient_id FROM etape_ingredient');
        $this->addSql('DROP TABLE etape_ingredient');
        $this->addSql('CREATE TABLE etape_ingredient (etape_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(etape_id, ingredient_id))');
        $this->addSql('INSERT INTO etape_ingredient (etape_id, ingredient_id) SELECT etape_id, ingredient_id FROM __temp__etape_ingredient');
        $this->addSql('DROP TABLE __temp__etape_ingredient');
        $this->addSql('CREATE INDEX IDX_5B37942C4A8CA2AD ON etape_ingredient (etape_id)');
        $this->addSql('CREATE INDEX IDX_5B37942C933FE08C ON etape_ingredient (ingredient_id)');
    }
}
