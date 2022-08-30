<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521214751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE supports_investi (id INT AUTO_INCREMENT NOT NULL, id_support_id INT NOT NULL, montant NUMERIC(10, 2) NOT NULL, date_invest DATE NOT NULL, INDEX IDX_466702CEA69F34D2 (id_support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE supports_investi ADD CONSTRAINT FK_466702CEA69F34D2 FOREIGN KEY (id_support_id) REFERENCES support (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE supports_investi');
    }
}
