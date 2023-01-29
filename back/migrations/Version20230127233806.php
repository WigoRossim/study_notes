<?php

declare(strict_types=1);

namespace Wigo\StudyNotes\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127233806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_6F8F552AA76ED395');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_6F8F552AA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Note DROP FOREIGN KEY FK_6F8F552AA76ED395');
        $this->addSql('ALTER TABLE Note ADD CONSTRAINT FK_6F8F552AA76ED395 FOREIGN KEY (user_id) REFERENCES note (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
