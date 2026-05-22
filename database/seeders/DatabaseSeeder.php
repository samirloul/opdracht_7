<?php

namespace Database\Seeders;

use App\Models\Allergeen;
use App\Models\BrandstofType;
use App\Models\Instructeur;
use App\Models\Leverancier;
use App\Models\TypeVoertuig;
use App\Models\Voertuig;
use App\Models\VoertuigInstructeur;
use App\Models\VoertuigLeverancier;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $typeVoertuigen = [
            1 => ['type_voertuig' => 'Personenauto', 'rijbewijscategorie' => 'B'],
            2 => ['type_voertuig' => 'Vrachtwagen', 'rijbewijscategorie' => 'C'],
            3 => ['type_voertuig' => 'Bus', 'rijbewijscategorie' => 'D'],
            4 => ['type_voertuig' => 'Bromfiets', 'rijbewijscategorie' => 'AM'],
        ];

        foreach ($typeVoertuigen as $id => $item) {
            TypeVoertuig::query()->updateOrCreate(['id' => $id], [
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        foreach (['Diesel', 'Benzine', 'Elektrisch'] as $brandstofNaam) {
            BrandstofType::query()->updateOrCreate(['naam' => $brandstofNaam], [
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        $instructeurs = [
            1 => ['voornaam' => 'Li', 'tussenvoegsel' => null, 'achternaam' => 'Zhan', 'mobiel' => '06-28493827', 'datum_in_dienst' => '2015-04-17', 'aantal_sterren' => 3],
            2 => ['voornaam' => 'Leroy', 'tussenvoegsel' => null, 'achternaam' => 'Boerhaven', 'mobiel' => '06-39398734', 'datum_in_dienst' => '2018-06-25', 'aantal_sterren' => 1],
            3 => ['voornaam' => 'Yoeri', 'tussenvoegsel' => 'Van', 'achternaam' => 'Veen', 'mobiel' => '06-24383291', 'datum_in_dienst' => '2010-05-12', 'aantal_sterren' => 3],
            4 => ['voornaam' => 'Bert', 'tussenvoegsel' => 'Van', 'achternaam' => 'Sali', 'mobiel' => '06-48293823', 'datum_in_dienst' => '2023-01-10', 'aantal_sterren' => 4],
            5 => ['voornaam' => 'Mohammed', 'tussenvoegsel' => 'El', 'achternaam' => 'Yassidi', 'mobiel' => '06-34291234', 'datum_in_dienst' => '2010-06-14', 'aantal_sterren' => 5],
        ];

        foreach ($instructeurs as $id => $item) {
            Instructeur::query()->updateOrCreate(['id' => $id], [
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        $voertuigen = [
            1 => ['kenteken' => 'AU-67-IO', 'type' => 'Golf', 'bouwjaar' => '2017-06-12', 'brandstof' => 'Diesel', 'type_voertuig_id' => 1],
            2 => ['kenteken' => 'TR-24-OP', 'type' => 'DAF', 'bouwjaar' => '2019-05-23', 'brandstof' => 'Diesel', 'type_voertuig_id' => 2],
            3 => ['kenteken' => 'TH-78-KL', 'type' => 'Mercedes', 'bouwjaar' => '2023-01-01', 'brandstof' => 'Benzine', 'type_voertuig_id' => 1],
            4 => ['kenteken' => '90-KL-TR', 'type' => 'Fiat 500', 'bouwjaar' => '2021-09-12', 'brandstof' => 'Benzine', 'type_voertuig_id' => 1],
            5 => ['kenteken' => '34-TK-LP', 'type' => 'Scania', 'bouwjaar' => '2015-03-13', 'brandstof' => 'Diesel', 'type_voertuig_id' => 2],
            6 => ['kenteken' => 'YY-OP-78', 'type' => 'BMW M5', 'bouwjaar' => '2022-05-13', 'brandstof' => 'Diesel', 'type_voertuig_id' => 1],
            7 => ['kenteken' => 'UU-HH-JK', 'type' => 'M.A.N', 'bouwjaar' => '2017-12-03', 'brandstof' => 'Diesel', 'type_voertuig_id' => 2],
            8 => ['kenteken' => 'ST-FZ-28', 'type' => 'Citroen', 'bouwjaar' => '2018-01-20', 'brandstof' => 'Elektrisch', 'type_voertuig_id' => 1],
            9 => ['kenteken' => '123-FR-T', 'type' => 'Piaggio ZIP', 'bouwjaar' => '2021-02-01', 'brandstof' => 'Benzine', 'type_voertuig_id' => 4],
            10 => ['kenteken' => 'DRS-52-P', 'type' => 'Vespa', 'bouwjaar' => '2022-03-21', 'brandstof' => 'Benzine', 'type_voertuig_id' => 4],
            11 => ['kenteken' => 'STP-12-U', 'type' => 'Kymco', 'bouwjaar' => '2022-07-02', 'brandstof' => 'Benzine', 'type_voertuig_id' => 4],
            12 => ['kenteken' => '45-SD-23', 'type' => 'Renault', 'bouwjaar' => '2023-01-01', 'brandstof' => 'Diesel', 'type_voertuig_id' => 3],
        ];

        foreach ($voertuigen as $id => $item) {
            Voertuig::query()->updateOrCreate(['id' => $id], [
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        $toewijzingen = [
            1 => ['voertuig_id' => 1, 'instructeur_id' => 5, 'datum_toekenning' => '2017-06-18'],
            2 => ['voertuig_id' => 3, 'instructeur_id' => 1, 'datum_toekenning' => '2021-09-26'],
            3 => ['voertuig_id' => 9, 'instructeur_id' => 1, 'datum_toekenning' => '2021-09-27'],
            4 => ['voertuig_id' => 4, 'instructeur_id' => 4, 'datum_toekenning' => '2022-08-01'],
            5 => ['voertuig_id' => 5, 'instructeur_id' => 1, 'datum_toekenning' => '2019-08-30'],
            6 => ['voertuig_id' => 10, 'instructeur_id' => 5, 'datum_toekenning' => '2020-02-02'],
            7 => ['voertuig_id' => 2, 'instructeur_id' => 5, 'datum_toekenning' => '2019-07-02'],
        ];

        foreach ($toewijzingen as $id => $item) {
            VoertuigInstructeur::query()->updateOrCreate(['id' => $id], [
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        $leveranciers = [
            1 => ['naam' => 'AutoWorx BV', 'contact_persoon' => 'I. Smits', 'telefoon' => '010-1234567'],
            2 => ['naam' => 'ScooterDepot NL', 'contact_persoon' => 'K. de Boer', 'telefoon' => '020-9876543'],
            3 => ['naam' => 'TruckParts Europa', 'contact_persoon' => 'M. Janssen', 'telefoon' => '040-3344556'],
            4 => ['naam' => 'Nieuwe Leverancier', 'contact_persoon' => 'N. Nieuw', 'telefoon' => '030-4567891'],
        ];

        foreach ($leveranciers as $id => $item) {
            Leverancier::query()->updateOrCreate(['id' => $id], [
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }

        $voertuigLeveranciers = [
            ['voertuig_id' => 1, 'leverancier_id' => 1, 'leverdatum' => '2017-06-01'],
            ['voertuig_id' => 2, 'leverancier_id' => 3, 'leverdatum' => '2019-05-01'],
            ['voertuig_id' => 10, 'leverancier_id' => 2, 'leverdatum' => '2022-03-01'],
            ['voertuig_id' => 11, 'leverancier_id' => 4, 'leverdatum' => '2022-06-20'],
        ];

        foreach ($voertuigLeveranciers as $item) {
            VoertuigLeverancier::query()->updateOrCreate(
                [
                    'voertuig_id' => $item['voertuig_id'],
                    'leverancier_id' => $item['leverancier_id'],
                ],
                [
                    'leverdatum' => $item['leverdatum'],
                    'is_actief' => true,
                    'opmerking' => null,
                    'datum_aangemaakt' => $now,
                    'datum_gewijzigd' => $now,
                ]
            );
        }

        $allergenen = [
            ['naam' => 'Gluten', 'omschrijving' => 'Aanwezig in graanproducten'],
            ['naam' => 'Lactose', 'omschrijving' => 'Aanwezig in zuivel'],
            ['naam' => 'Pinda', 'omschrijving' => 'Notenallergie risico'],
            ['naam' => 'Soja', 'omschrijving' => 'Soja-eiwit allergie'],
            ['naam' => 'Schaaldieren', 'omschrijving' => 'Allergie voor schaal- en schelpdieren'],
            ['naam' => 'Eieren', 'omschrijving' => 'Allergie voor ei-eiwit'],
        ];

        foreach ($allergenen as $item) {
            Allergeen::query()->create([
                ...$item,
                'is_actief' => true,
                'opmerking' => null,
                'datum_aangemaakt' => $now,
                'datum_gewijzigd' => $now,
            ]);
        }
    }
}
