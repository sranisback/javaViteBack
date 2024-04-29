<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416212338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DD9D86650F');
        $this->addSql('DROP INDEX IDX_6A3254DD9D86650F ON pilote');
        $this->addSql('ALTER TABLE pilote CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6A3254DDA76ED395 ON pilote (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DDA76ED395');
        $this->addSql('DROP INDEX IDX_6A3254DDA76ED395 ON pilote');
        $this->addSql('ALTER TABLE pilote CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6A3254DD9D86650F ON pilote (user_id_id)');
    }
}
