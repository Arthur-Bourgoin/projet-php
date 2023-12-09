CREATE USER 'userProjectPHP'@'localhost' IDENTIFIED BY 'pwdproject';

CREATE DATABASE projectPHP;

GRANT ALL PRIVILEGES ON projectPHP.* TO 'userProjectPHP'@'localhost';

USE projectPHP;

CREATE TABLE Medecin(
   idMedecin INT AUTO_INCREMENT,
   photo VARCHAR(100),
   civilite CHAR(1),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(idMedecin)
) ENGINE = InnoDB;

CREATE TABLE Usager(
   idUsager INT AUTO_INCREMENT,
   photo VARCHAR(100),
   nir CHAR(15),
   civilite CHAR(1),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   ville VARCHAR(50),
   codePostal CHAR(5),
   adresse VARCHAR(150),
   dateNaissance DATE,
   lieuNaissance VARCHAR(50),
   idMedecin INT,
   PRIMARY KEY(idUsager),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin)
) ENGINE = InnoDB;

CREATE TABLE RDV(
   idMedecin INT,
   dateHeureDebut DATETIME,
   duree INT,
   idUsager INT NOT NULL,
   PRIMARY KEY(idMedecin, dateHeureDebut),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin),
   FOREIGN KEY(idUsager) REFERENCES Usager(idUsager)
) ENGINE = InnoDB;

