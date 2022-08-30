<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511094255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE support_categorie (support_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_FFAF4D82315B405 (support_id), INDEX IDX_FFAF4D82BCF5E72D (categorie_id), PRIMARY KEY(support_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support_schema (support_id INT NOT NULL, schema_id INT NOT NULL, INDEX IDX_3074A1A2315B405 (support_id), INDEX IDX_3074A1A2EA1BEF35 (schema_id), PRIMARY KEY(support_id, schema_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE support_categorie ADD CONSTRAINT FK_FFAF4D82315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support_categorie ADD CONSTRAINT FK_FFAF4D82BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support_schema ADD CONSTRAINT FK_3074A1A2315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support_schema ADD CONSTRAINT FK_3074A1A2EA1BEF35 FOREIGN KEY (schema_id) REFERENCES schemasdata (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categorie_support');
        $this->addSql('DROP TABLE schema_support');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_support (categorie_id INT NOT NULL, support_id INT NOT NULL, INDEX IDX_DF874507BCF5E72D (categorie_id), INDEX IDX_DF874507315B405 (support_id), PRIMARY KEY(categorie_id, support_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE schema_support (schema_id INT NOT NULL, support_id INT NOT NULL, INDEX IDX_53EB6D3EA1BEF35 (schema_id), INDEX IDX_53EB6D3315B405 (support_id), PRIMARY KEY(schema_id, support_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_support ADD CONSTRAINT FK_DF874507315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_support ADD CONSTRAINT FK_DF874507BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schema_support ADD CONSTRAINT FK_53EB6D3315B405 FOREIGN KEY (support_id) REFERENCES support (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schema_support ADD CONSTRAINT FK_53EB6D3EA1BEF35 FOREIGN KEY (schema_id) REFERENCES schemasdata (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE support_categorie');
        $this->addSql('DROP TABLE support_schema');
    }
}
