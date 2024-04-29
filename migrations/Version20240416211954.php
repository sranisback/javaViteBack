<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416211954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championnat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE championnat_user (championnat_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FC91E8F9627A0DA8 (championnat_id), INDEX IDX_FC91E8F9A76ED395 (user_id), PRIMARY KEY(championnat_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE championnat_pilote (championnat_id INT NOT NULL, pilote_id INT NOT NULL, INDEX IDX_4F9696CC627A0DA8 (championnat_id), INDEX IDX_4F9696CCF510AAE9 (pilote_id), PRIMARY KEY(championnat_id, pilote_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USER_NAME (user_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, modele VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture_pilote (voiture_id INT NOT NULL, pilote_id INT NOT NULL, INDEX IDX_49C69EC7181A8BA (voiture_id), INDEX IDX_49C69EC7F510AAE9 (pilote_id), PRIMARY KEY(voiture_id, pilote_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE championnat_user ADD CONSTRAINT FK_FC91E8F9627A0DA8 FOREIGN KEY (championnat_id) REFERENCES championnat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE championnat_user ADD CONSTRAINT FK_FC91E8F9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE championnat_pilote ADD CONSTRAINT FK_4F9696CC627A0DA8 FOREIGN KEY (championnat_id) REFERENCES championnat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE championnat_pilote ADD CONSTRAINT FK_4F9696CCF510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_pilote ADD CONSTRAINT FK_49C69EC7181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_pilote ADD CONSTRAINT FK_49C69EC7F510AAE9 FOREIGN KEY (pilote_id) REFERENCES pilote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pilote ADD user_id_id INT NOT NULL, CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE pilote ADD CONSTRAINT FK_6A3254DD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6A3254DD9D86650F ON pilote (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilote DROP FOREIGN KEY FK_6A3254DD9D86650F');
        $this->addSql('ALTER TABLE championnat_user DROP FOREIGN KEY FK_FC91E8F9627A0DA8');
        $this->addSql('ALTER TABLE championnat_user DROP FOREIGN KEY FK_FC91E8F9A76ED395');
        $this->addSql('ALTER TABLE championnat_pilote DROP FOREIGN KEY FK_4F9696CC627A0DA8');
        $this->addSql('ALTER TABLE championnat_pilote DROP FOREIGN KEY FK_4F9696CCF510AAE9');
        $this->addSql('ALTER TABLE voiture_pilote DROP FOREIGN KEY FK_49C69EC7181A8BA');
        $this->addSql('ALTER TABLE voiture_pilote DROP FOREIGN KEY FK_49C69EC7F510AAE9');
        $this->addSql('DROP TABLE championnat');
        $this->addSql('DROP TABLE championnat_user');
        $this->addSql('DROP TABLE championnat_pilote');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE voiture_pilote');
        $this->addSql('DROP INDEX IDX_6A3254DD9D86650F ON pilote');
        $this->addSql('ALTER TABLE pilote DROP user_id_id, CHANGE name name VARCHAR(25) NOT NULL');
    }
}
