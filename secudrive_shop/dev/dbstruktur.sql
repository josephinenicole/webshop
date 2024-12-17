create database secudrive_shop; 

CREATE TABLE `produkt` (
  `id` int(11) NOT NULL,
  `artikel` varchar(255) DEFAULT NULL,
  `hersteller` text NOT NULL,
  `bild` longblob DEFAULT NULL,
  `kurzbeschreibung` text NOT NULL,
  `detailbeschreibung` text NOT NULL,
  `preis` float DEFAULT NULL,
  `gewicht` int(11) DEFAULT NULL,
  `attribute` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- DATENBANK CHECKOUT --

create database secudrive_checkout; 

CREATE TABLE registerform (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  email VARCHAR(30),
  adresse VARCHAR(70),
  stadt VARCHAR(30),
  bundesland VARCHAR(70),
  postleitzahl INT,
  karteninhaber VARCHAR(70),
  kreditkartennummer VARCHAR(16), -- Da Kreditkartennummern normalerweise alphanumerisch sind, sollten sie als VARCHAR behandelt werden
  gueltig_monat DATE, -- Gültigkeitsdatum sollte als DATE gespeichert werden
  gueltig_jahr DATE,
  karte_cvv INT
) DEFAULT CHARACTER SET utf8;
