<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507215314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_support (categorie_id INT NOT NULL, support_id INT NOT NULL, INDEX IDX_DF874507BCF5E72D (categorie_id), INDEX IDX_DF874507315B405 (support_id), PRIMARY KEY(categorie_id, support_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodicite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schema_taux (id INT AUTO_INCREMENT NOT NULL, schema_id INT NOT NULL, taux_client NUMERIC(5, 2) NOT NULL, taux_net NUMERIC(5, 2) NOT NULL, taux_brut NUMERIC(5, 2) NOT NULL, taux_emetteur NUMERIC(5, 2) NOT NULL, taux_cnp NUMERIC(5, 2) NOT NULL, taux_distributeur NUMERIC(5, 2) NOT NULL, part_cnp NUMERIC(5, 2) NOT NULL, date_debut_commerce DATE NOT NULL, date_fin_commerce DATE NOT NULL, INDEX IDX_7B73FCAFEA1BEF35 (schema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schemasdata (id INT AUTO_INCREMENT NOT NULL, type_frais_id INT NOT NULL, periodicite_id INT NOT NULL, nom VARCHAR(255) NOT NULL, confirme_mfex TINYINT(1) NOT NULL, INDEX IDX_522BF0B472AE4A38 (type_frais_id), INDEX IDX_522BF0B42928752A (periodicite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schema_support (schema_id INT NOT NULL, support_id INT NOT NULL, INDEX IDX_53EB6D3EA1BEF35 (schema_id), INDEX IDX_53EB6D3315B405 (support_id), PRIMARY KEY(schema_id, support_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, emetteur_id INT NOT NULL, isin VARCHAR(20) NOT NULL, nom VARCHAR(255) DEFAULT NULL, date_premier_investist DATE NOT NULL, date_fin_invest DATE NOT NULL, montant_invest INT NOT NULL, INDEX IDX_8004EBA579E92E8C (emetteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_frais (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_support ADD CONSTRAINT FK_DF874507BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_support ADD CONSTRAINT FK_DF874507315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schema_taux ADD CONSTRAINT FK_7B73FCAFEA1BEF35 FOREIGN KEY (schema_id) REFERENCES schemasdata (id)');
        $this->addSql('ALTER TABLE schemasdata ADD CONSTRAINT FK_522BF0B472AE4A38 FOREIGN KEY (type_frais_id) REFERENCES type_frais (id)');
        $this->addSql('ALTER TABLE schemasdata ADD CONSTRAINT FK_522BF0B42928752A FOREIGN KEY (periodicite_id) REFERENCES periodicite (id)');
        $this->addSql('ALTER TABLE schema_support ADD CONSTRAINT FK_53EB6D3EA1BEF35 FOREIGN KEY (schema_id) REFERENCES schemasdata (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schema_support ADD CONSTRAINT FK_53EB6D3315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA579E92E8C FOREIGN KEY (emetteur_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_support DROP FOREIGN KEY FK_DF874507BCF5E72D');
        $this->addSql('ALTER TABLE schemasdata DROP FOREIGN KEY FK_522BF0B42928752A');
        $this->addSql('ALTER TABLE schema_taux DROP FOREIGN KEY FK_7B73FCAFEA1BEF35');
        $this->addSql('ALTER TABLE schema_support DROP FOREIGN KEY FK_53EB6D3EA1BEF35');
        $this->addSql('ALTER TABLE categorie_support DROP FOREIGN KEY FK_DF874507315B405');
        $this->addSql('ALTER TABLE schema_support DROP FOREIGN KEY FK_53EB6D3315B405');
        $this->addSql('ALTER TABLE schemasdata DROP FOREIGN KEY FK_522BF0B472AE4A38');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA579E92E8C');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_support');
        $this->addSql('DROP TABLE periodicite');
        $this->addSql('DROP TABLE schema_taux');
        $this->addSql('DROP TABLE schemasdata');
        $this->addSql('DROP TABLE schema_support');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE type_frais');
        $this->addSql('DROP TABLE `user`');
    }
}
