<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180712122636 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE comment (id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX IDX_A8BCA45A76ED395');
        $this->addSql('DROP INDEX UNIQ_A8BCA45989D9B62');
        $this->addSql('CREATE TEMPORARY TABLE __temp__idea AS SELECT id, user_id, title, slug, created_at, updated_at FROM idea');
        $this->addSql('DROP TABLE idea');
        $this->addSql('CREATE TABLE idea (id INTEGER NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_A8BCA45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO idea (id, user_id, title, slug, created_at, updated_at) SELECT id, user_id, title, slug, created_at, updated_at FROM __temp__idea');
        $this->addSql('DROP TABLE __temp__idea');
        $this->addSql('CREATE INDEX IDX_A8BCA45A76ED395 ON idea (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8BCA45989D9B62 ON idea (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP INDEX UNIQ_A8BCA45989D9B62');
        $this->addSql('DROP INDEX IDX_A8BCA45A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__idea AS SELECT id, user_id, title, slug, created_at, updated_at FROM idea');
        $this->addSql('DROP TABLE idea');
        $this->addSql('CREATE TABLE idea (id INTEGER NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO idea (id, user_id, title, slug, created_at, updated_at) SELECT id, user_id, title, slug, created_at, updated_at FROM __temp__idea');
        $this->addSql('DROP TABLE __temp__idea');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8BCA45989D9B62 ON idea (slug)');
        $this->addSql('CREATE INDEX IDX_A8BCA45A76ED395 ON idea (user_id)');
    }
}
