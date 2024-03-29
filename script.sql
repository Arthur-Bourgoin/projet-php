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

CREATE TABLE Rdv(
   idRdv INT AUTO_INCREMENT,
   idMedecin INT NOT NULL,
   dateHeureDebut DATETIME,
   duree INT,
   idUsager INT NOT NULL,
   PRIMARY KEY(idRdv),
   FOREIGN KEY(idMedecin) REFERENCES Medecin(idMedecin) ON DELETE CASCADE,
   FOREIGN KEY(idUsager) REFERENCES Usager(idUsager) ON DELETE CASCADE
) ENGINE = InnoDB;

DELIMITER //
CREATE TRIGGER tbi_usager_transformIdMedecin
BEFORE INSERT
ON Usager
FOR EACH ROW
BEGIN
   IF NEW.idMedecin = 0 THEN
      SET NEW.idMedecin = null;
   END IF;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tbu_usager_transformIdMedecin
BEFORE UPDATE
ON Usager
FOR EACH ROW
BEGIN
   IF NEW.idMedecin = 0 THEN
      SET NEW.idMedecin = null;
   END IF;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tbd_medecin_nullFKUser
BEFORE DELETE
ON Medecin
FOR EACH ROW
BEGIN
   UPDATE Usager SET idMedecin = NULL 
                 WHERE idMedecin = OLD.idMedecin;
END;
//
DELIMITER ;
