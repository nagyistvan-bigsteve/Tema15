<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308145214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE angajat (id INT AUTO_INCREMENT NOT NULL, nume VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depozit (id INT AUTO_INCREMENT NOT NULL, angajat_id INT NOT NULL, nume VARCHAR(255) NOT NULL, locatie VARCHAR(255) NOT NULL, data_intrare DATE NOT NULL, data_iesire DATE DEFAULT NULL, UNIQUE INDEX UNIQ_9A0AA6B6CE81EAD5 (angajat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marfa (id INT AUTO_INCREMENT NOT NULL, depozit_id INT NOT NULL, nume VARCHAR(255) NOT NULL, descriere VARCHAR(255) DEFAULT NULL, data_expirari DATE DEFAULT NULL, fragil TINYINT(1) NOT NULL, greutate DOUBLE PRECISION NOT NULL, volum DOUBLE PRECISION NOT NULL, INDEX IDX_7A7DF556BF1AB579 (depozit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depozit ADD CONSTRAINT FK_9A0AA6B6CE81EAD5 FOREIGN KEY (angajat_id) REFERENCES angajat (id)');
        $this->addSql('ALTER TABLE marfa ADD CONSTRAINT FK_7A7DF556BF1AB579 FOREIGN KEY (depozit_id) REFERENCES depozit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depozit DROP FOREIGN KEY FK_9A0AA6B6CE81EAD5');
        $this->addSql('ALTER TABLE marfa DROP FOREIGN KEY FK_7A7DF556BF1AB579');
        $this->addSql('DROP TABLE angajat');
        $this->addSql('DROP TABLE depozit');
        $this->addSql('DROP TABLE marfa');
    }
}
