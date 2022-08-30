<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605172838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_investissement CHANGE montant_net montant_net NUMERIC(11, 2) NOT NULL, CHANGE qte_net qte_net NUMERIC(11, 2) NOT NULL, CHANGE valeur_uc valeur_uc NUMERIC(11, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_investissement CHANGE montant_net montant_net INT NOT NULL, CHANGE qte_net qte_net INT NOT NULL, CHANGE valeur_uc valeur_uc INT NOT NULL');
    }
}
