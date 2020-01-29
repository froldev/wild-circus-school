<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129101312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE internship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, start_date VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, civility VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE representation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_school_class (artist_id INT NOT NULL, school_class_id INT NOT NULL, INDEX IDX_DB204100B7970CF8 (artist_id), INDEX IDX_DB20410014463F54 (school_class_id), PRIMARY KEY(artist_id, school_class_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, school_class_id INT DEFAULT NULL, internship_id INT DEFAULT NULL, representation_id INT DEFAULT NULL, INDEX IDX_5E90F6D614463F54 (school_class_id), INDEX IDX_5E90F6D67A4A70BE (internship_id), INDEX IDX_5E90F6D646CE82F4 (representation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_user (inscription_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AC25ADFA5DAC5993 (inscription_id), INDEX IDX_AC25ADFAA76ED395 (user_id), PRIMARY KEY(inscription_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_school_class ADD CONSTRAINT FK_DB204100B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_school_class ADD CONSTRAINT FK_DB20410014463F54 FOREIGN KEY (school_class_id) REFERENCES school_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D614463F54 FOREIGN KEY (school_class_id) REFERENCES school_class (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67A4A70BE FOREIGN KEY (internship_id) REFERENCES internship (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D646CE82F4 FOREIGN KEY (representation_id) REFERENCES representation (id)');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D67A4A70BE');
        $this->addSql('ALTER TABLE artist_school_class DROP FOREIGN KEY FK_DB20410014463F54');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D614463F54');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFAA76ED395');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D646CE82F4');
        $this->addSql('ALTER TABLE artist_school_class DROP FOREIGN KEY FK_DB204100B7970CF8');
        $this->addSql('ALTER TABLE inscription_user DROP FOREIGN KEY FK_AC25ADFA5DAC5993');
        $this->addSql('DROP TABLE internship');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE school_class');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE representation');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_school_class');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_user');
    }
}
