<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323144230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments CHANGE post_id_id post_id_id INT NOT NULL, CHANGE user_id_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts CHANGE created_id_id created_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments CHANGE post_id_id post_id_id INT DEFAULT NULL, CHANGE user_id_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts CHANGE created_id_id created_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` DROP roles');
    }
}
