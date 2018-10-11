<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181011104312 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_user (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particulier (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, nombre_point INT NOT NULL, UNIQUE INDEX UNIQ_6CC4D4F39D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dechet (id INT AUTO_INCREMENT NOT NULL, type_dechet_id_id INT NOT NULL, particulier_id_id INT NOT NULL, quantite_utilise INT NOT NULL, quantite INT NOT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_53C0FC60EFB80427 (type_dechet_id_id), INDEX IDX_53C0FC60A2ED8BF0 (particulier_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, type_user_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, password VARCHAR(255) NOT NULL, user_code VARCHAR(255) NOT NULL, INDEX IDX_8D93D6498085B32A (type_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, commercant_id_id INT NOT NULL, particulier_id_id INT NOT NULL, code_promo INT NOT NULL, is_used TINYINT(1) NOT NULL, INDEX IDX_64BF3F0266F3FE6B (commercant_id_id), INDEX IDX_64BF3F02A2ED8BF0 (particulier_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_dechet (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercant (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, siret INT NOT NULL, logo VARCHAR(255) NOT NULL, denomination VARCHAR(255) NOT NULL, adresse_siege VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_ECB4268F9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE particulier ADD CONSTRAINT FK_6CC4D4F39D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE dechet ADD CONSTRAINT FK_53C0FC60EFB80427 FOREIGN KEY (type_dechet_id_id) REFERENCES type_dechet (id)');
        $this->addSql('ALTER TABLE dechet ADD CONSTRAINT FK_53C0FC60A2ED8BF0 FOREIGN KEY (particulier_id_id) REFERENCES particulier (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498085B32A FOREIGN KEY (type_user_id_id) REFERENCES type_user (id)');
        $this->addSql('ALTER TABLE coupon ADD CONSTRAINT FK_64BF3F0266F3FE6B FOREIGN KEY (commercant_id_id) REFERENCES commercant (id)');
        $this->addSql('ALTER TABLE coupon ADD CONSTRAINT FK_64BF3F02A2ED8BF0 FOREIGN KEY (particulier_id_id) REFERENCES particulier (id)');
        $this->addSql('ALTER TABLE commercant ADD CONSTRAINT FK_ECB4268F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498085B32A');
        $this->addSql('ALTER TABLE dechet DROP FOREIGN KEY FK_53C0FC60A2ED8BF0');
        $this->addSql('ALTER TABLE coupon DROP FOREIGN KEY FK_64BF3F02A2ED8BF0');
        $this->addSql('ALTER TABLE particulier DROP FOREIGN KEY FK_6CC4D4F39D86650F');
        $this->addSql('ALTER TABLE commercant DROP FOREIGN KEY FK_ECB4268F9D86650F');
        $this->addSql('ALTER TABLE dechet DROP FOREIGN KEY FK_53C0FC60EFB80427');
        $this->addSql('ALTER TABLE coupon DROP FOREIGN KEY FK_64BF3F0266F3FE6B');
        $this->addSql('DROP TABLE type_user');
        $this->addSql('DROP TABLE particulier');
        $this->addSql('DROP TABLE dechet');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE type_dechet');
        $this->addSql('DROP TABLE commercant');
    }
}
