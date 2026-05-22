# Database Specificatie Tabel

## Algemene systeemvelden op alle 8 tabellen
- IsActief: BIT, NOT NULL, default 1
- Opmerking: VARCHAR(250), NULL
- DatumAangemaakt: DATETIME(6), NOT NULL
- DatumGewijzigd: DATETIME(6), NOT NULL

## Tabel: instructeurs
- id: BIGINT UNSIGNED, PK, AUTO_INCREMENT
- voornaam: VARCHAR(80), NOT NULL
- tussenvoegsel: VARCHAR(30), NULL
- achternaam: VARCHAR(80), NOT NULL
- mobiel: VARCHAR(20), NOT NULL
- datum_in_dienst: DATE, NOT NULL
- aantal_sterren: TINYINT UNSIGNED, NOT NULL

## Tabel: type_voertuigs
- id: BIGINT UNSIGNED, PK
- type_voertuig: VARCHAR(60), NOT NULL
- rijbewijscategorie: VARCHAR(10), NOT NULL

## Tabel: voertuigs
- id: BIGINT UNSIGNED, PK
- kenteken: VARCHAR(15), NOT NULL, UNIQUE
- type: VARCHAR(120), NOT NULL
- bouwjaar: DATE, NOT NULL
- brandstof: VARCHAR(20), NOT NULL
- type_voertuig_id: BIGINT UNSIGNED, FK -> type_voertuigs.id

## Tabel: voertuig_instructeurs
- id: BIGINT UNSIGNED, PK
- voertuig_id: BIGINT UNSIGNED, FK -> voertuigs.id, UNIQUE
- instructeur_id: BIGINT UNSIGNED, FK -> instructeurs.id
- datum_toekenning: DATE, NOT NULL

## Tabel: leveranciers
- id: BIGINT UNSIGNED, PK
- naam: VARCHAR(120), NOT NULL
- contact_persoon: VARCHAR(120), NULL
- telefoon: VARCHAR(20), NULL

## Tabel: voertuig_leveranciers
- id: BIGINT UNSIGNED, PK
- voertuig_id: BIGINT UNSIGNED, FK -> voertuigs.id
- leverancier_id: BIGINT UNSIGNED, FK -> leveranciers.id
- leverdatum: DATE, NULL
- unique(voertuig_id, leverancier_id)

## Tabel: brandstof_types
- id: BIGINT UNSIGNED, PK
- naam: VARCHAR(30), NOT NULL, UNIQUE

## Tabel: allergeens
- id: BIGINT UNSIGNED, PK
- naam: VARCHAR(120), NOT NULL
- omschrijving: VARCHAR(250), NULL
