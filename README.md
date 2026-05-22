# BE-opdracht 07 - Feature 1

Laravel MVC-applicatie voor examentraining Software Developer.

## Inhoud
- Instructeurs in dienst (gesorteerd op sterren)
- Overzicht door instructeur gebruikte voertuigen
- Wijzigen voertuiggegevens (scenario 01-04)
- Overzicht allergenen met pagination (max 4 records)
- Unit tests + feature tests

## Techniek
- PHP 8+
- Laravel 13
- MySQL (verplicht voor stored procedure)
- HTML/CSS/JS

## Lokale installatie

1. Clone repository
```bash
git clone https://github.com/samirloul/opdracht_7.git
cd opdracht_7
```

2. Dependencies installeren
```bash
composer install
```

3. Environment bestand
```bash
copy .env.example .env
php artisan key:generate
```

4. Zet MySQL variabelen in .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=be_opdracht7
DB_USERNAME=root
DB_PASSWORD=
```

5. Config cache leegmaken
```bash
php artisan config:clear
```

## Database setup

Je hebt 2 opties:

### Optie A (aanbevolen): Laravel migraties + seeder
```bash
php artisan migrate:fresh --seed
```

### Optie B: volledige SQL import
Importeer [db/create_database.sql](db/create_database.sql) in MySQL/phpMyAdmin.

## Stored procedure installeren (MySQL)

Voer het script uit:
- [db/stored_procedures.sql](db/stored_procedures.sql)

Voorbeeld via MySQL CLI:
```bash
mysql -u root -p be_opdracht7 < db/stored_procedures.sql
```

## App starten
```bash
php artisan serve
```

Open daarna:
- `http://127.0.0.1:8000/`

## Tests draaien
```bash
php artisan test
```

## Belangrijke mappen
- `app/Http/Controllers` MVC controllers
- `app/Models` Eloquent modellen
- `app/Services/VoertuigService.php` businesslogica
- `resources/views` Blade views
- `database/migrations` datastructuur
- `database/seeders` testdata
- `db` SQL scripts
- `docs` class diagram, ERD, testplan, testrapport

## Zelf pushen naar GitHub

Omdat jij zelf commit/push doet, kun je dit gebruiken:

```bash
git remote remove origin
git remote add origin https://github.com/samirloul/opdracht_7.git
git add .
git commit -m "Update README and project files"
git push -u origin feature-opdracht7
```

Als je naar `main` wilt pushen:
```bash
git checkout main
git merge feature-opdracht7
git push -u origin main
```
