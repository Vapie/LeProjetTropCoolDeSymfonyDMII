<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124131718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etape (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_action_id INTEGER NOT NULL, recette_id INTEGER NOT NULL, etape_index INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_285F75DDB02145DA ON etape (etape_action_id)');
        $this->addSql('CREATE INDEX IDX_285F75DD89312FE9 ON etape (recette_id)');
        $this->addSql('CREATE TABLE etape_ingredient (etape_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(etape_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_5B37942C4A8CA2AD ON etape_ingredient (etape_id)');
        $this->addSql('CREATE INDEX IDX_5B37942C933FE08C ON etape_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE recette (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_B19DB1C8C47B8755');
        $this->addSql('DROP INDEX IDX_B19DB1C89D32F035');
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_ingredient_type AS SELECT action_id, ingredient_type_id FROM action_ingredient_type');
        $this->addSql('DROP TABLE action_ingredient_type');
        $this->addSql('CREATE TABLE action_ingredient_type (action_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(action_id, ingredient_type_id), CONSTRAINT FK_B19DB1C89D32F035 FOREIGN KEY (action_id) REFERENCES "action" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B19DB1C8C47B8755 FOREIGN KEY (ingredient_type_id) REFERENCES ingredient_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO action_ingredient_type (action_id, ingredient_type_id) SELECT action_id, ingredient_type_id FROM __temp__action_ingredient_type');
        $this->addSql('DROP TABLE __temp__action_ingredient_type');
        $this->addSql('CREATE INDEX IDX_B19DB1C8C47B8755 ON action_ingredient_type (ingredient_type_id)');
        $this->addSql('CREATE INDEX IDX_B19DB1C89D32F035 ON action_ingredient_type (action_id)');
        $this->addSql('DROP INDEX IDX_485EE350C47B8755');
        $this->addSql('DROP INDEX IDX_485EE350933FE08C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_ingredient_type AS SELECT ingredient_id, ingredient_type_id FROM ingredient_ingredient_type');
        $this->addSql('DROP TABLE ingredient_ingredient_type');
        $this->addSql('CREATE TABLE ingredient_ingredient_type (ingredient_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, ingredient_type_id), CONSTRAINT FK_485EE350933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_485EE350C47B8755 FOREIGN KEY (ingredient_type_id) REFERENCES ingredient_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient_ingredient_type (ingredient_id, ingredient_type_id) SELECT ingredient_id, ingredient_type_id FROM __temp__ingredient_ingredient_type');
        $this->addSql('DROP TABLE __temp__ingredient_ingredient_type');
        $this->addSql('CREATE INDEX IDX_485EE350C47B8755 ON ingredient_ingredient_type (ingredient_type_id)');
        $this->addSql('CREATE INDEX IDX_485EE350933FE08C ON ingredient_ingredient_type (ingredient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE etape_ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP INDEX IDX_B19DB1C89D32F035');
        $this->addSql('DROP INDEX IDX_B19DB1C8C47B8755');
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_ingredient_type AS SELECT action_id, ingredient_type_id FROM action_ingredient_type');
        $this->addSql('DROP TABLE action_ingredient_type');
        $this->addSql('CREATE TABLE action_ingredient_type (action_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(action_id, ingredient_type_id))');
        $this->addSql('INSERT INTO action_ingredient_type (action_id, ingredient_type_id) SELECT action_id, ingredient_type_id FROM __temp__action_ingredient_type');
        $this->addSql('DROP TABLE __temp__action_ingredient_type');
        $this->addSql('CREATE INDEX IDX_B19DB1C89D32F035 ON action_ingredient_type (action_id)');
        $this->addSql('CREATE INDEX IDX_B19DB1C8C47B8755 ON action_ingredient_type (ingredient_type_id)');
        $this->addSql('DROP INDEX IDX_485EE350933FE08C');
        $this->addSql('DROP INDEX IDX_485EE350C47B8755');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_ingredient_type AS SELECT ingredient_id, ingredient_type_id FROM ingredient_ingredient_type');
        $this->addSql('DROP TABLE ingredient_ingredient_type');
        $this->addSql('CREATE TABLE ingredient_ingredient_type (ingredient_id INTEGER NOT NULL, ingredient_type_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, ingredient_type_id))');
        $this->addSql('INSERT INTO ingredient_ingredient_type (ingredient_id, ingredient_type_id) SELECT ingredient_id, ingredient_type_id FROM __temp__ingredient_ingredient_type');
        $this->addSql('DROP TABLE __temp__ingredient_ingredient_type');
        $this->addSql('CREATE INDEX IDX_485EE350933FE08C ON ingredient_ingredient_type (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_485EE350C47B8755 ON ingredient_ingredient_type (ingredient_type_id)');
    }
}
