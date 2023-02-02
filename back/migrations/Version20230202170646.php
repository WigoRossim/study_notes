<?php

declare(strict_types=1);

namespace Wigo\StudyNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202170646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Note (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, nivel VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, INDEX IDX_6F8F552AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Note ADD CONSTRAINT FK_6F8F552AA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Note DROP FOREIGN KEY FK_6F8F552AA76ED395');
        $this->addSql('DROP TABLE Note');
        $this->addSql('DROP TABLE User');
    }
}
