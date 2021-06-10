<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610195004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE node (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, child_left_id INTEGER DEFAULT NULL, child_right_id INTEGER DEFAULT NULL, parent_id INTEGER DEFAULT NULL, user_name VARCHAR(255) NOT NULL, credits_left DOUBLE PRECISION NOT NULL, credits_right DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_857FE84580D88619 ON node (child_left_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_857FE845DE901591 ON node (child_right_id)');
        $this->addSql('CREATE INDEX IDX_857FE845727ACA70 ON node (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE node');
    }
}
