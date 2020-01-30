<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130102847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category_artist');
        $this->addSql('ALTER TABLE category ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE internship ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE partner ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE school_class ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE artist ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_artist (category_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_EB15CFC12469DE2 (category_id), INDEX IDX_EB15CFCB7970CF8 (artist_id), PRIMARY KEY(category_id, artist_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_artist ADD CONSTRAINT FK_EB15CFC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_artist ADD CONSTRAINT FK_EB15CFCB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist DROP updated_at');
        $this->addSql('ALTER TABLE category DROP updated_at');
        $this->addSql('ALTER TABLE internship DROP updated_at');
        $this->addSql('ALTER TABLE partner DROP updated_at');
        $this->addSql('ALTER TABLE school_class DROP updated_at');
    }
}
