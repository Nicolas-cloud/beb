<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306094342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Trajet (id INT AUTO_INCREMENT NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, heure_depart DATETIME NOT NULL, heure_arrivee DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, nb_places INT NOT NULL, description VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, avis_trajet_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, INDEX IDX_8F91ABF0AB47B7E2 (avis_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, reserve_trajet_id INT DEFAULT NULL, date_reservation DATE NOT NULL, validation TINYINT(1) NOT NULL, annulation TINYINT(1) NOT NULL, INDEX IDX_42C84955B67818E0 (reserve_trajet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0AB47B7E2 FOREIGN KEY (avis_trajet_id) REFERENCES Trajet (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B67818E0 FOREIGN KEY (reserve_trajet_id) REFERENCES Trajet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0AB47B7E2');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B67818E0');
        $this->addSql('DROP TABLE Trajet');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reservation');
    }
}
