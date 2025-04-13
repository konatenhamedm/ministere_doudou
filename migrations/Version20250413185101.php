<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413185101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE07294869C');
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE0AF7BD910');
        $this->addSql('ALTER TABLE affectation_employe DROP FOREIGN KEY FK_3A0BFD061B65292');
        $this->addSql('ALTER TABLE affectation_employe DROP FOREIGN KEY FK_3A0BFD066D0ABA22');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66747AD248');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE ligne_mouvement DROP FOREIGN KEY FK_94B4F3B67294869C');
        $this->addSql('ALTER TABLE ligne_mouvement DROP FOREIGN KEY FK_94B4F3B6ECD1C222');
        $this->addSql('ALTER TABLE ligne_sortie DROP FOREIGN KEY FK_1AE54FB47294869C');
        $this->addSql('ALTER TABLE ligne_sortie DROP FOREIGN KEY FK_1AE54FB4CC72D953');
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EDE5D515D');
        $this->addSql('DROP TABLE affectation_employe');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE chef_lieu');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE entree');
        $this->addSql('DROP TABLE ligne_mouvement');
        $this->addSql('DROP TABLE ligne_sortie');
        $this->addSql('DROP TABLE mouvement');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('ALTER TABLE ligne_demande ADD CONSTRAINT FK_B90DE99C80E95E18 FOREIGN KEY (demande_id) REFERENCES stock_demande (id)');
        $this->addSql('ALTER TABLE ligne_demande ADD CONSTRAINT FK_B90DE99C7294869C FOREIGN KEY (article_id) REFERENCES param_article (id)');
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE07294869C');
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE0AF7BD910');
        $this->addSql('ALTER TABLE ligne_entree ADD CONSTRAINT FK_7F59EBE07294869C FOREIGN KEY (article_id) REFERENCES param_article (id)');
        $this->addSql('ALTER TABLE ligne_entree ADD CONSTRAINT FK_7F59EBE0AF7BD910 FOREIGN KEY (entree_id) REFERENCES stock_entree (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affectation_employe (affectation_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_3A0BFD061B65292 (employe_id), INDEX IDX_3A0BFD066D0ABA22 (affectation_id), PRIMARY KEY(affectation_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, lignedemandes_id INT DEFAULT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, seuil INT NOT NULL, quantite INT NOT NULL, INDEX IDX_23A0E66747AD248 (lignedemandes_id), INDEX IDX_23A0E66BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chef_lieu (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_demande DATETIME NOT NULL, date_validation DATETIME DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE entree (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ligne_mouvement (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, mouvement_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_94B4F3B67294869C (article_id), INDEX IDX_94B4F3B6ECD1C222 (mouvement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ligne_sortie (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, sortie_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_1AE54FB47294869C (article_id), INDEX IDX_1AE54FB4CC72D953 (sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mouvement (id INT AUTO_INCREMENT NOT NULL, sens_id INT DEFAULT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, INDEX IDX_5B51FC3EDE5D515D (sens_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sortie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE affectation_employe ADD CONSTRAINT FK_3A0BFD061B65292 FOREIGN KEY (employe_id) REFERENCES _admin_employe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affectation_employe ADD CONSTRAINT FK_3A0BFD066D0ABA22 FOREIGN KEY (affectation_id) REFERENCES affectation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66747AD248 FOREIGN KEY (lignedemandes_id) REFERENCES ligne_demande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_mouvement ADD CONSTRAINT FK_94B4F3B67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_mouvement ADD CONSTRAINT FK_94B4F3B6ECD1C222 FOREIGN KEY (mouvement_id) REFERENCES mouvement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_sortie ADD CONSTRAINT FK_1AE54FB47294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_sortie ADD CONSTRAINT FK_1AE54FB4CC72D953 FOREIGN KEY (sortie_id) REFERENCES sortie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EDE5D515D FOREIGN KEY (sens_id) REFERENCES sens (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_demande DROP FOREIGN KEY FK_B90DE99C80E95E18');
        $this->addSql('ALTER TABLE ligne_demande DROP FOREIGN KEY FK_B90DE99C7294869C');
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE0AF7BD910');
        $this->addSql('ALTER TABLE ligne_entree DROP FOREIGN KEY FK_7F59EBE07294869C');
        $this->addSql('ALTER TABLE ligne_entree ADD CONSTRAINT FK_7F59EBE0AF7BD910 FOREIGN KEY (entree_id) REFERENCES entree (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ligne_entree ADD CONSTRAINT FK_7F59EBE07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
