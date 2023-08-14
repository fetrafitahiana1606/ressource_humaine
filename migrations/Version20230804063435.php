<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804063435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attendance_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, first_name VARCHAR(32) NOT NULL, last_name VARCHAR(32) NOT NULL, email VARCHAR(255) NOT NULL, hire_date DATE NOT NULL, job_title VARCHAR(32) NOT NULL, salary DOUBLE PRECISION NOT NULL, INDEX IDX_5D9F75A1CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `leave` (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, reason VARCHAR(255) NOT NULL, INDEX IDX_9BB080D08C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payroll (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, pay_date DATE NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, deductions DOUBLE PRECISION DEFAULT NULL, INDEX IDX_499FBCC68C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time_attendace (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, attendance_status_id INT NOT NULL, check_in DATETIME NOT NULL, check_out DATETIME NOT NULL, date DATE NOT NULL, INDEX IDX_FF38DAF68C03F15C (employee_id), INDEX IDX_FF38DAF61E73AA87 (attendance_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE `leave` ADD CONSTRAINT FK_9BB080D08C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE payroll ADD CONSTRAINT FK_499FBCC68C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE time_attendace ADD CONSTRAINT FK_FF38DAF68C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE time_attendace ADD CONSTRAINT FK_FF38DAF61E73AA87 FOREIGN KEY (attendance_status_id) REFERENCES attendance_status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1CCF9E01E');
        $this->addSql('ALTER TABLE `leave` DROP FOREIGN KEY FK_9BB080D08C03F15C');
        $this->addSql('ALTER TABLE payroll DROP FOREIGN KEY FK_499FBCC68C03F15C');
        $this->addSql('ALTER TABLE time_attendace DROP FOREIGN KEY FK_FF38DAF68C03F15C');
        $this->addSql('ALTER TABLE time_attendace DROP FOREIGN KEY FK_FF38DAF61E73AA87');
        $this->addSql('DROP TABLE attendance_status');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE `leave`');
        $this->addSql('DROP TABLE payroll');
        $this->addSql('DROP TABLE time_attendace');
        $this->addSql('DROP TABLE user');
    }
}
