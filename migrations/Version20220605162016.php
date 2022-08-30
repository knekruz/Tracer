<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605162016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE support_investissement (id INT AUTO_INCREMENT NOT NULL, id_support_id INT NOT NULL, id_invest INT NOT NULL, date_pos DATE NOT NULL, montant_net INT NOT NULL, qte_net INT NOT NULL, valeur_uc INT NOT NULL, INDEX IDX_71B23D70A69F34D2 (id_support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support_taux (id INT AUTO_INCREMENT NOT NULL, id_support_id INT NOT NULL, taux NUMERIC(5, 2) DEFAULT NULL, debut_commerce DATE DEFAULT NULL, fin_commerce DATE DEFAULT NULL, INDEX IDX_588CAB2EA69F34D2 (id_support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE support_investissement ADD CONSTRAINT FK_71B23D70A69F34D2 FOREIGN KEY (id_support_id) REFERENCES support (id)');
        $this->addSql('ALTER TABLE support_taux ADD CONSTRAINT FK_588CAB2EA69F34D2 FOREIGN KEY (id_support_id) REFERENCES support (id)');
        $this->addSql('DROP TABLE supports_investi');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE supports_investi (id INT AUTO_INCREMENT NOT NULL, id_support_id INT NOT NULL, montant NUMERIC(10, 2) NOT NULL, date_invest DATE NOT NULL, INDEX IDX_466702CEA69F34D2 (id_support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE supports_investi ADD CONSTRAINT FK_466702CEA69F34D2 FOREIGN KEY (id_support_id) REFERENCES support (id)');
        $this->addSql('DROP TABLE support_investissement');
        $this->addSql('DROP TABLE support_taux');
    }
}
