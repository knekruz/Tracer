<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624024159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_taux ADD status VARCHAR(255) DEFAULT NULL, CHANGE taux_mfex taux_mfex NUMERIC(10, 6) DEFAULT NULL, CHANGE taux_brut taux_brut NUMERIC(10, 6) DEFAULT NULL, CHANGE taux_net taux_net NUMERIC(10, 6) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_taux DROP status, CHANGE taux_mfex taux_mfex NUMERIC(5, 2) DEFAULT NULL, CHANGE taux_brut taux_brut NUMERIC(5, 2) DEFAULT NULL, CHANGE taux_net taux_net NUMERIC(5, 2) DEFAULT NULL');
    }
}
