<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129124707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_category DROP FOREIGN KEY FK_F97AE113CD11A2CF');
        $this->addSql('CREATE TABLE produit_category (produit_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_2F532BD2F347EFB (produit_id), INDEX IDX_2F532BD212469DE2 (category_id), PRIMARY KEY(produit_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_category ADD CONSTRAINT FK_2F532BD2F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_category ADD CONSTRAINT FK_2F532BD212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE produits_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produits_category (produits_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_F97AE113CD11A2CF (produits_id), INDEX IDX_F97AE11312469DE2 (category_id), PRIMARY KEY(produits_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produits_category ADD CONSTRAINT FK_F97AE11312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_category ADD CONSTRAINT FK_F97AE113CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE produit_category');
    }
}
