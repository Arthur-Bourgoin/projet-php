INSERT INTO Medecin (idMedecin, civilite, photo, nom, prenom)
VALUES
(1, 'F', 'user24.png', 'Leclerc', 'Claire'),
(2, 'M', 'user22.png', 'Boucher', 'Nicolas'),
(3, 'F', 'user23.png', 'Clarac', 'Isabelle');

INSERT INTO Usager (idUsager, nir, civilite, photo, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, idMedecin)
VALUES
(1, '123456789012345', 'M', 'user1.png', 'Dupont', 'Jean', 'Paris', '75001', '123 Rue de la Santé', '1970-05-15', 'Paris', 1),
(2, '987654321098765', 'F', 'user2.png', 'Martin', 'Sophie', 'Marseille', '13001', '456 Avenue de la Santé', '1963-08-22', 'Marseille', 2),
(3, '111223334445556', 'F', 'user3.png', 'Lefevre', 'Marie', 'Lyon', '69001', '789 Boulevard de la Santé', '2003-02-10', 'Lyon', 3),
(4, '444433322211100', 'M', 'user4.png', 'Robert', 'Pierre', 'Toulouse', '31000', '987 Rue de la Santé', '1959-11-28', 'Toulouse', 1),
(5, '888877776665554', 'F', 'user6.png', 'Bouvier', 'Elise', 'Nice', '06000', '654 Avenue de la Santé', '2017-07-07', 'Nice', 2),
(6, '999988887776665', 'M', 'user5.png', 'Lemoine', 'Antoine', 'Strasbourg', '67000', '321 Rue de la Santé', '1971-04-18', 'Strasbourg', 3),
(7, '555566667778899', 'F', 'user9.png', 'Roux', 'Julie', 'Bordeaux', '33000', '159 Boulevard de la Santé', '1993-09-03', 'Bordeaux', 1),
(8, '777766665554433', 'M', 'user7.png', 'Girard', 'Louis', 'Lille', '59000', '753 Avenue de la Santé', '2005-12-07', 'Lille', 2),
(9, '121212121212121', 'F', 'user12.png', 'Leroy', 'Camille', 'Rennes', '35000', '456 Rue de la Santé', '1958-01-25', 'Rennes', 3),
(10, '343434343434343', 'M', 'user10.png', 'Moreau', 'Luc', 'Nantes', '44000', '987 Boulevard de la Santé', '1970-06-12', 'Nantes', 1),
(11, '565656565656565', 'F', 'user13.png', 'Dufour', 'Emma', 'Montpellier', '34000', '654 Avenue de la Santé', '1942-04-30', 'Montpellier', 2),
(12, '787878787878787', 'M', 'user11.png', 'Martin', 'Hugo', 'Toulon', '83000', '321 Rue de la Santé', '2006-11-15', 'Toulon', 2),
(13, '123443211234432', 'F', 'user15.png', 'Bertrand', 'Chloé', 'Grenoble', '38000', '159 Boulevard de la Santé', '2007-07-22', 'Grenoble', 1),
(14, '567890123456789', 'M', 'user14.png', 'Dubois', 'Thomas', 'Dijon', '21000', '753 Avenue de la Santé', '2000-03-05', 'Dijon', 2),
(15, '987654321234567', 'F', 'user16.png', 'Lefort', 'Léa', 'Angers', '49000', '456 Rue de la Santé', '1997-10-18', 'Angers', null),
(16, '135791357913579', 'M', 'user17.png', 'Simon', 'Adam', 'Metz', '57000', '987 Boulevard de la Santé', '2016-05-31', 'Metz', 1),
(17, '246802468024680', 'F', 'user20.png', 'Garnier', 'Louise', 'Brest', '29000', '654 Avenue de la Santé', '1994-02-14', 'Brest', 2),
(18, '987654321012345', 'M', 'user18.png', 'Marchand', 'Paul', 'Lorient', '56100', '321 Rue de la Santé', '1976-09-07', 'Lorient', 3),
(19, '111222333444555', 'F', 'user23.png', 'Brun', 'Mélissa', 'Le Havre', '76600', '159 Boulevard de la Santé', '1999-12-24', 'Le Havre', null),
(20, '555444333222111', 'M', 'user19.png', 'Dupuis', 'Alexandre', 'Reims', '51100', '753 Avenue de la Santé', '2014-06-08', 'Reims', 2),
(21, '111122223334455', 'F', 'user24.png', 'Gauthier', 'Sophie', 'Marseille', '13003', '789 Avenue de la Santé', '1987-04-12', 'Marseille', 2),
(22, '444455556667788', 'M', 'user21.png', 'Leroux', 'Marc', 'Nice', '06004', '456 Rue de la Santé', '1992-09-28', 'Nice', 3),
(23, '999988877766655', 'F', 'user25.png', 'Besson', 'Léa', 'Toulouse', '31002', '123 Boulevard de la Santé', '1979-12-03', 'Toulouse', 1),
(24, '333322211100099', 'M', 'user22.png', 'Lefevre', 'Pierre', 'Strasbourg', '67002', '987 Rue de la Santé', '1995-11-28', 'Strasbourg', 3),
(25, '777766655544433', 'F', 'user26.png', 'Morel', 'Elise', 'Nice', '06005', '654 Avenue de la Santé', '1952-07-07', 'Nice', 3),
(26, '555588889999111', 'M', 'user35.png', 'Durand', 'Antoine', 'Montpellier', '34003', '321 Rue de la Santé', '1975-04-18', 'Montpellier', 1),
(27, '444455556667788', 'F', 'user27.png', 'Mercier', 'Julie', 'Bordeaux', '33003', '159 Boulevard de la Santé', '1993-09-03', 'Bordeaux', null),
(28, '111133322211100', 'M', 'user36.png', 'Perrin', 'Louis', 'Lille', '59003', '753 Avenue de la Santé', '1967-12-07', 'Lille', 3),
(29, '787766665554433', 'F', 'user28.png', 'Lemoine', 'Camille', 'Rennes', '35003', '456 Rue de la Santé', '1998-01-25', 'Rennes', 3),
(30, '888877766655544', 'M', 'user37.png', 'Fournier', 'Luc', 'Nantes', '44003', '987 Boulevard de la Santé', '1972-06-12', 'Nantes', null),
(31, '222266667778899', 'F', 'user29.png', 'Marie', 'Emma', 'Toulon', '83002', '654 Avenue de la Santé', '1996-04-30', 'Toulon', 3),
(32, '111144443322211', 'M', 'user38.png', 'Martin', 'Hugo', 'Lyon', '69004', '321 Rue de la Santé', '1984-11-15', 'Lyon', 2),
(33, '121212121212121', 'F', 'user30.png', 'Moulin', 'Chloé', 'Paris', '75003', '456 Rue de la Santé', '1998-01-25', 'Paris', 2),
(34, '343434343434343', 'M', 'user39.png', 'Martin', 'Lucas', 'Bordeaux', '33004', '159 Boulevard de la Santé', '1970-06-12', 'Bordeaux', 2),
(35, '565656565656565', 'F', 'user31.png', 'Renaud', 'Emma', 'Montpellier', '34004', '654 Avenue de la Santé', '2002-04-30', 'Montpellier', 1),
(36, '787878787878787', 'M', 'user40.png', 'Lefevre', 'Hugo', 'Toulon', '83003', '321 Rue de la Santé', '2004-11-15', 'Toulon', 3),
(37, '123443211234432', 'F', 'user32.png', 'Lefort', 'Chloé', 'Grenoble', '38001', '159 Boulevard de la Santé', '1953-07-22', 'Grenoble', null),
(38, '567890123456789', 'M', 'user41.png', 'Picard', 'Thomas', 'Dijon', '21001', '753 Avenue de la Santé', '1978-03-05', 'Dijon', 1),
(39, '987654321234567', 'F', 'user33.png', 'Dupuis', 'Léa', 'Angers', '49001', '456 Rue de la Santé', '1997-10-18', 'Angers', 2),
(40, '135791357913579', 'M', 'user42.png', 'Giraud', 'Adam', 'Metz', '57001', '987 Boulevard de la Santé', '1983-05-31', 'Metz', 3),
(41, '246802468024680', 'F', 'user34.png', 'Guerin', 'Louise', 'Brest', '29001', '654 Avenue de la Santé', '1972-02-14', 'Brest', 1);

INSERT INTO Rdv (idMedecin, dateHeureDebut, duree, idUsager) VALUES
(1, '2023-12-07 08:00:00', 30, 1),
(2, '2023-12-08 10:30:00', 45, 2),
(3, '2023-12-09 13:15:00', 60, 3),
(1, '2023-12-10 14:45:00', 30, 4),
(2, '2023-12-11 16:00:00', 45, 5),
(3, '2023-12-12 09:30:00', 60, 6),
(1, '2023-12-13 11:15:00', 30, 7),
(2, '2023-12-14 13:45:00', 45, 8),
(3, '2023-12-15 15:00:00', 60, 9),
(1, '2023-12-16 08:30:00', 30, 10),
(2, '2023-12-17 10:45:00', 45, 11),
(3, '2023-12-18 12:00:00', 60, 12),
(1, '2023-12-19 14:15:00', 30, 13),
(2, '2023-12-20 16:30:00', 45, 14),
(3, '2023-12-21 09:00:00', 60, 15),
(1, '2023-12-22 11:30:00', 30, 16),
(2, '2023-12-23 13:45:00', 45, 17),
(3, '2023-12-24 15:00:00', 60, 18),
(1, '2023-12-25 08:30:00', 30, 19),
(2, '2023-12-26 10:45:00', 45, 20),
(3, '2023-12-27 12:00:00', 60, 21),
(1, '2023-12-28 14:15:00', 30, 22),
(2, '2023-12-29 16:30:00', 45, 23),
(3, '2023-12-30 09:00:00', 60, 24),
(1, '2023-12-31 11:30:00', 30, 25),
(2, '2024-01-01 13:45:00', 45, 26),
(3, '2024-01-02 15:00:00', 60, 27),
(1, '2024-01-03 08:30:00', 30, 28),
(2, '2024-01-04 10:45:00', 45, 29),
(3, '2024-01-05 12:00:00', 60, 30),
(1, '2024-01-06 14:15:00', 30, 31),
(2, '2024-01-07 16:30:00', 45, 32),
(3, '2024-01-08 09:00:00', 60, 33),
(1, '2024-01-09 11:30:00', 30, 34),
(2, '2024-01-10 13:45:00', 45, 35),
(3, '2024-01-11 15:00:00', 60, 36),
(1, '2024-01-12 08:30:00', 30, 37),
(2, '2024-01-13 10:45:00', 45, 38),
(3, '2024-01-14 12:00:00', 60, 39),
(1, '2024-01-15 14:15:00', 30, 40),
(2, '2024-01-16 16:30:00', 45, 1),
(3, '2024-01-17 09:00:00', 60, 2),
(1, '2024-01-18 11:30:00', 30, 3),
(2, '2024-01-19 13:45:00', 45, 4),
(3, '2024-01-20 15:00:00', 60, 5),
(1, '2024-01-21 08:30:00', 30, 6),
(2, '2024-01-22 10:45:00', 45, 7),
(3, '2024-01-23 12:00:00', 60, 8),
(1, '2024-01-24 14:15:00', 30, 9),
(2, '2024-01-25 16:30:00', 45, 10),
(3, '2024-01-26 09:00:00', 60, 11),
(1, '2024-01-27 11:30:00', 30, 12),
(2, '2024-01-28 13:45:00', 45, 13),
(3, '2024-01-29 15:00:00', 60, 14),
(1, '2024-01-30 08:30:00', 30, 15),
(2, '2024-01-31 10:45:00', 45, 16),
(3, '2024-02-01 12:00:00', 60, 17),
(1, '2024-02-02 14:15:00', 30, 18),
(2, '2024-02-03 16:30:00', 45, 19),
(3, '2024-02-04 09:00:00', 60, 20),
(1, '2024-02-05 11:30:00', 30, 21),
(2, '2024-02-06 13:45:00', 45, 22),
(3, '2024-02-07 15:00:00', 60, 23),
(1, '2024-02-08 08:30:00', 30, 24),
(2, '2024-02-09 10:45:00', 45, 25),
(3, '2024-02-10 12:00:00', 60, 26),
(1, '2024-02-11 14:15:00', 30, 27),
(2, '2024-02-12 16:30:00', 45, 28),
(3, '2024-02-13 09:00:00', 60, 29),
(1, '2024-02-14 11:30:00', 30, 30),
(2, '2024-02-15 13:45:00', 45, 31),
(3, '2024-02-16 15:00:00', 60, 32),
(1, '2024-02-17 08:30:00', 30, 33),
(2, '2024-02-18 10:45:00', 45, 34),
(3, '2024-02-19 12:00:00', 60, 35),
(1, '2024-02-20 14:15:00', 30, 36),
(2, '2024-02-21 16:30:00', 45, 37),
(3, '2024-02-22 09:00:00', 60, 38),
(1, '2024-02-23 11:30:00', 30, 39),
(2, '2024-02-24 13:45:00', 45, 40);
