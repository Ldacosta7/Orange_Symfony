<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209140619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP id_categorie');
        $this->addSql('ALTER TABLE intervention DROP id_intervention');
        $this->addSql('ALTER TABLE materiel DROP id_materiel');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD id_categorie INT NOT NULL');
        $this->addSql('ALTER TABLE intervention ADD id_intervention INT NOT NULL');
        $this->addSql('ALTER TABLE materiel ADD id_materiel INT DEFAULT NULL');
    }
}
