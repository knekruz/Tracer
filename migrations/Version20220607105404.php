<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607105404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_taux ADD id_schema_id INT NOT NULL');
        $this->addSql('ALTER TABLE support_taux ADD CONSTRAINT FK_588CAB2E6A2E5312 FOREIGN KEY (id_schema_id) REFERENCES schemasdata (id)');
        $this->addSql('CREATE INDEX IDX_588CAB2E6A2E5312 ON support_taux (id_schema_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_taux DROP FOREIGN KEY FK_588CAB2E6A2E5312');
        $this->addSql('DROP INDEX IDX_588CAB2E6A2E5312 ON support_taux');
        $this->addSql('ALTER TABLE support_taux DROP id_schema_id');
    }
}
