-- BE-opdracht 07 - create script (MySQL)
DROP DATABASE IF EXISTS be_opdracht7;
CREATE DATABASE be_opdracht7 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE be_opdracht7;

CREATE TABLE instructeurs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    voornaam VARCHAR(80) NOT NULL,
    tussenvoegsel VARCHAR(30) NULL,
    achternaam VARCHAR(80) NOT NULL,
    mobiel VARCHAR(20) NOT NULL,
    datum_in_dienst DATE NOT NULL,
    aantal_sterren TINYINT UNSIGNED NOT NULL DEFAULT 0,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL
);

CREATE TABLE type_voertuigs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type_voertuig VARCHAR(60) NOT NULL,
    rijbewijscategorie VARCHAR(10) NOT NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL
);

CREATE TABLE voertuigs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kenteken VARCHAR(15) NOT NULL UNIQUE,
    type VARCHAR(120) NOT NULL,
    bouwjaar DATE NOT NULL,
    brandstof VARCHAR(20) NOT NULL,
    type_voertuig_id BIGINT UNSIGNED NOT NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL,
    CONSTRAINT fk_voertuig_type FOREIGN KEY (type_voertuig_id) REFERENCES type_voertuigs(id)
);

CREATE TABLE voertuig_instructeurs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    voertuig_id BIGINT UNSIGNED NOT NULL UNIQUE,
    instructeur_id BIGINT UNSIGNED NOT NULL,
    datum_toekenning DATE NOT NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL,
    CONSTRAINT fk_vi_voertuig FOREIGN KEY (voertuig_id) REFERENCES voertuigs(id),
    CONSTRAINT fk_vi_instructeur FOREIGN KEY (instructeur_id) REFERENCES instructeurs(id)
);

CREATE TABLE leveranciers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(120) NOT NULL,
    contact_persoon VARCHAR(120) NULL,
    telefoon VARCHAR(20) NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL
);

CREATE TABLE voertuig_leveranciers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    voertuig_id BIGINT UNSIGNED NOT NULL,
    leverancier_id BIGINT UNSIGNED NOT NULL,
    leverdatum DATE NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL,
    UNIQUE KEY uk_voertuig_leverancier (voertuig_id, leverancier_id),
    CONSTRAINT fk_vl_voertuig FOREIGN KEY (voertuig_id) REFERENCES voertuigs(id),
    CONSTRAINT fk_vl_leverancier FOREIGN KEY (leverancier_id) REFERENCES leveranciers(id)
);

CREATE TABLE brandstof_types (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(30) NOT NULL UNIQUE,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL
);

CREATE TABLE allergeens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(120) NOT NULL,
    omschrijving VARCHAR(250) NULL,
    is_actief BIT NOT NULL DEFAULT b'1',
    opmerking VARCHAR(250) NULL,
    datum_aangemaakt DATETIME(6) NOT NULL,
    datum_gewijzigd DATETIME(6) NOT NULL
);

INSERT INTO type_voertuigs (id, type_voertuig, rijbewijscategorie, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 'Personenauto', 'B', b'1', NULL, NOW(6), NOW(6)),
(2, 'Vrachtwagen', 'C', b'1', NULL, NOW(6), NOW(6)),
(3, 'Bus', 'D', b'1', NULL, NOW(6), NOW(6)),
(4, 'Bromfiets', 'AM', b'1', NULL, NOW(6), NOW(6));

INSERT INTO instructeurs (id, voornaam, tussenvoegsel, achternaam, mobiel, datum_in_dienst, aantal_sterren, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 'Li', NULL, 'Zhan', '06-28493827', '2015-04-17', 3, b'1', NULL, NOW(6), NOW(6)),
(2, 'Leroy', NULL, 'Boerhaven', '06-39398734', '2018-06-25', 1, b'1', NULL, NOW(6), NOW(6)),
(3, 'Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', 3, b'1', NULL, NOW(6), NOW(6)),
(4, 'Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', 4, b'1', NULL, NOW(6), NOW(6)),
(5, 'Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', 5, b'1', NULL, NOW(6), NOW(6));

INSERT INTO voertuigs (id, kenteken, type, bouwjaar, brandstof, type_voertuig_id, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 'AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1, b'1', NULL, NOW(6), NOW(6)),
(2, 'TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2, b'1', NULL, NOW(6), NOW(6)),
(3, 'TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1, b'1', NULL, NOW(6), NOW(6)),
(4, '90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1, b'1', NULL, NOW(6), NOW(6)),
(5, '34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2, b'1', NULL, NOW(6), NOW(6)),
(6, 'YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1, b'1', NULL, NOW(6), NOW(6)),
(7, 'UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2, b'1', NULL, NOW(6), NOW(6)),
(8, 'ST-FZ-28', 'Citroen', '2018-01-20', 'Elektrisch', 1, b'1', NULL, NOW(6), NOW(6)),
(9, '123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4, b'1', NULL, NOW(6), NOW(6)),
(10, 'DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4, b'1', NULL, NOW(6), NOW(6)),
(11, 'STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4, b'1', NULL, NOW(6), NOW(6)),
(12, '45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3, b'1', NULL, NOW(6), NOW(6));

INSERT INTO voertuig_instructeurs (id, voertuig_id, instructeur_id, datum_toekenning, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 1, 5, '2017-06-18', b'1', NULL, NOW(6), NOW(6)),
(2, 3, 1, '2021-09-26', b'1', NULL, NOW(6), NOW(6)),
(3, 9, 1, '2021-09-27', b'1', NULL, NOW(6), NOW(6)),
(4, 4, 4, '2022-08-01', b'1', NULL, NOW(6), NOW(6)),
(5, 5, 1, '2019-08-30', b'1', NULL, NOW(6), NOW(6)),
(6, 10, 5, '2020-02-02', b'1', NULL, NOW(6), NOW(6)),
(7, 2, 5, '2019-07-02', b'1', NULL, NOW(6), NOW(6));

INSERT INTO leveranciers (id, naam, contact_persoon, telefoon, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 'AutoWorx BV', 'I. Smits', '010-1234567', b'1', NULL, NOW(6), NOW(6)),
(2, 'ScooterDepot NL', 'K. de Boer', '020-9876543', b'1', NULL, NOW(6), NOW(6)),
(3, 'TruckParts Europa', 'M. Janssen', '040-3344556', b'1', NULL, NOW(6), NOW(6)),
(4, 'Nieuwe Leverancier', 'N. Nieuw', '030-4567891', b'1', NULL, NOW(6), NOW(6));

INSERT INTO voertuig_leveranciers (voertuig_id, leverancier_id, leverdatum, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
(1, 1, '2017-06-01', b'1', NULL, NOW(6), NOW(6)),
(2, 3, '2019-05-01', b'1', NULL, NOW(6), NOW(6)),
(10, 2, '2022-03-01', b'1', NULL, NOW(6), NOW(6)),
(11, 4, '2022-06-20', b'1', NULL, NOW(6), NOW(6));

INSERT INTO brandstof_types (naam, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
('Diesel', b'1', NULL, NOW(6), NOW(6)),
('Benzine', b'1', NULL, NOW(6), NOW(6)),
('Elektrisch', b'1', NULL, NOW(6), NOW(6));

INSERT INTO allergeens (naam, omschrijving, is_actief, opmerking, datum_aangemaakt, datum_gewijzigd) VALUES
('Gluten', 'Aanwezig in graanproducten', b'1', NULL, NOW(6), NOW(6)),
('Lactose', 'Aanwezig in zuivel', b'1', NULL, NOW(6), NOW(6)),
('Pinda', 'Notenallergie risico', b'1', NULL, NOW(6), NOW(6)),
('Soja', 'Soja-eiwit allergie', b'1', NULL, NOW(6), NOW(6)),
('Schaaldieren', 'Allergie voor schaal- en schelpdieren', b'1', NULL, NOW(6), NOW(6)),
('Eieren', 'Allergie voor ei-eiwit', b'1', NULL, NOW(6), NOW(6));
