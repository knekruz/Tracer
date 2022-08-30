<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605164530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE schema_taux');
        $this->addSql('ALTER TABLE schemasdata DROP confirme_mfex');
        $this->addSql('ALTER TABLE support_taux ADD taux_emetteur NUMERIC(5, 2) DEFAULT NULL, ADD taux_cnp NUMERIC(5, 2) DEFAULT NULL, ADD taux_distributeur NUMERIC(5, 2) DEFAULT NULL, ADD part_cnp INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE schema_taux (id INT AUTO_INCREMENT NOT NULL, schema_id INT NOT NULL, taux_client NUMERIC(5, 2) NOT NULL, taux_net NUMERIC(5, 2) NOT NULL, taux_brut NUMERIC(5, 2) NOT NULL, taux_emetteur NUMERIC(5, 2) NOT NULL, taux_cnp NUMERIC(5, 2) NOT NULL, taux_distributeur NUMERIC(5, 2) NOT NULL, part_cnp NUMERIC(5, 2) NOT NULL, date_debut_commerce DATE NOT NULL, date_fin_commerce DATE DEFAULT NULL, INDEX IDX_7B73FCAFEA1BEF35 (schema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE schema_taux ADD CONSTRAINT FK_7B73FCAFEA1BEF35 FOREIGN KEY (schema_id) REFERENCES schemasdata (id)');
        $this->addSql('ALTER TABLE schemasdata ADD confirme_mfex TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE support_taux DROP taux_emetteur, DROP taux_cnp, DROP taux_distributeur, DROP part_cnp');
    }
}
