<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129150939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_inscription (user_id INT NOT NULL, inscription_id INT NOT NULL, INDEX IDX_F78B3F43A76ED395 (user_id), INDEX IDX_F78B3F435DAC5993 (inscription_id), PRIMARY KEY(user_id, inscription_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_inscription ADD CONSTRAINT FK_F78B3F43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_inscription ADD CONSTRAINT FK_F78B3F435DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE inscription_user');
        $this->addSql('ALTER TABLE school_class ADD inscription_id INT DEFAULT NULL, CHANGE start_date start_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE school_class ADD CONSTRAINT FK_33B1AF855DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('CREATE INDEX IDX_33B1AF855DAC5993 ON school_class (inscription_id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D614463F54');
        $this->addSql('DROP INDEX IDX_5E90F6D614463F54 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP school_class_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inscription_user (inscription_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AC25ADFA5DAC5993 (inscription_id), INDEX IDX_AC25ADFAA76ED395 (user_id), PRIMARY KEY(inscription_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFA5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_user ADD CONSTRAINT FK_AC25ADFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_inscription');
        $this->addSql('ALTER TABLE inscription ADD school_class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D614463F54 FOREIGN KEY (school_class_id) REFERENCES school_class (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5E90F6D614463F54 ON inscription (school_class_id)');
        $this->addSql('ALTER TABLE school_class DROP FOREIGN KEY FK_33B1AF855DAC5993');
        $this->addSql('DROP INDEX IDX_33B1AF855DAC5993 ON school_class');
        $this->addSql('ALTER TABLE school_class DROP inscription_id, CHANGE start_date start_date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
