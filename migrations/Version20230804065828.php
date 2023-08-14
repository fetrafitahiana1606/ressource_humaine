<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804065828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE time_attendance (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, attendance_status_id INT NOT NULL, check_in DATETIME NOT NULL, check_out DATETIME NOT NULL, date DATE NOT NULL, INDEX IDX_E579217C8C03F15C (employee_id), INDEX IDX_E579217C1E73AA87 (attendance_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time_attendance ADD CONSTRAINT FK_E579217C8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE time_attendance ADD CONSTRAINT FK_E579217C1E73AA87 FOREIGN KEY (attendance_status_id) REFERENCES attendance_status (id)');
        $this->addSql('ALTER TABLE time_attendace DROP FOREIGN KEY FK_FF38DAF61E73AA87');
        $this->addSql('ALTER TABLE time_attendace DROP FOREIGN KEY FK_FF38DAF68C03F15C');
        $this->addSql('DROP TABLE time_attendace');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE time_attendace (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, attendance_status_id INT NOT NULL, check_in DATETIME NOT NULL, check_out DATETIME NOT NULL, date DATE NOT NULL, INDEX IDX_FF38DAF68C03F15C (employee_id), INDEX IDX_FF38DAF61E73AA87 (attendance_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE time_attendace ADD CONSTRAINT FK_FF38DAF61E73AA87 FOREIGN KEY (attendance_status_id) REFERENCES attendance_status (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE time_attendace ADD CONSTRAINT FK_FF38DAF68C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE time_attendance DROP FOREIGN KEY FK_E579217C8C03F15C');
        $this->addSql('ALTER TABLE time_attendance DROP FOREIGN KEY FK_E579217C1E73AA87');
        $this->addSql('DROP TABLE time_attendance');
    }
}
