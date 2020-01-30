<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130081000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE school_class ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE school_class ADD CONSTRAINT FK_33B1AF8512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_33B1AF8512469DE2 ON school_class (category_id)');
        $this->addSql('ALTER TABLE category ADD picture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP picture');
        $this->addSql('ALTER TABLE school_class DROP FOREIGN KEY FK_33B1AF8512469DE2');
        $this->addSql('DROP INDEX IDX_33B1AF8512469DE2 ON school_class');
        $this->addSql('ALTER TABLE school_class DROP category_id');
    }
}
