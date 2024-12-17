---TESTDATEN Tabelle PRODUKT---

INSERT INTO `produkt` (`id`, `artikel`, `hersteller`, `bild`, `kurzbeschreibung`, `detailbeschreibung`, 
`preis`, `gewicht`, `attribute`) VALUES
(16, 'Navigationssystem', 'Secudrive', NULL, 'tolles produkt', 'wird ergänzt', 199, 1, 'folgt noch!!!!'),
(17, 'Erster Artikel', 'Hersteller 1', NULL, 'tolles produkt', 'wird ergänzt', 250, 8, 'folgt noch!!!!'),
(18, 'Sicherheitsgurt', 'Secudrive', NULL, 'tolles produkt', 'wird ergänzt', 150, 4, 'folgt noch!!!!'),
(19, 'Lenkrad', 'Secudrive', NULL, 'tolles produkt', 'wird ergänzt', 125, 6, 'folgt noch!!!!'),
(21, 'Warnweste', 'Secudrive', NULL, 'tolles produkt', 'wird ergänzt', 45, 1, 'folgt noch!!!!'),
(22, 'artikel 1', 'hersteller 1', NULL, 'neu', 'test ', 0.99, 2, 'später');


---Testdaten Tabelle REGISTERFORM---
INSERT INTO registerform (name, email, adresse, stadt, bundesland, postleitzahl, karteninhaber, kreditkartennummer, gueltig_monat, gueltig_jahr, karte_cvv) VALUES
('Max Mustermann', 'max@example.com', 'Musterstraße 123', 'Musterstadt', 'Musterbundesland', 12345, 'Max Mustermann', '1234567890123456', '2024-12-01', '2026-12-01', 123),
('Maria Musterfrau', 'maria@example.com', 'Beispielweg 456', 'Beispielstadt', 'Beispielbundesland', 54321, 'Maria Musterfrau', '9876543210987654', '2025-06-01', '2027-06-01', 456),
('Hans Tester', 'hans@test.com', 'Testweg 789', 'Teststadt', 'Testbundesland', 98765, 'Hans Tester', '1111222233334444', '2023-09-01', '2025-09-01', 789),
('Laura Test', 'laura@test.com', 'Teststraße 10', 'Testhausen', 'Testland', 10101, 'Laura Test', '5555666677778888', '2026-03-01', '2028-03-01', 987),
('Erika Beispiel', 'erika@example.com', 'Beispielallee 321', 'Beispielort', 'Beispielstaat', 67890, 'Erika Beispiel', '9999000011112222', '2024-11-01', '2026-11-01', 654);



