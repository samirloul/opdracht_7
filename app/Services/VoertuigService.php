<?php

namespace App\Services;

use App\Models\Voertuig;
use App\Models\VoertuigInstructeur;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VoertuigService
{
    public function normalizeKenteken(string $kenteken): string
    {
        return strtoupper(trim($kenteken));
    }

    public function isBouwjaarReadonly(string $type): bool
    {
        return strtoupper(trim($type)) === 'DAF';
    }

    /**
     * Werkt voertuiggegevens bij en wijzigt eventueel de toegewezen instructeur.
     */
    public function updateVoertuig(int $voertuigId, array $data): Voertuig
    {
        return DB::transaction(function () use ($voertuigId, $data): Voertuig {
            $now = Carbon::now();
            $voertuig = Voertuig::query()->findOrFail($voertuigId);

            $isDaf = $this->isBouwjaarReadonly($voertuig->type);
            $bouwjaar = $isDaf
                ? Carbon::parse($voertuig->bouwjaar)->toDateString()
                : Carbon::parse($data['bouwjaar'])->toDateString();

            $voertuig->fill([
                'type_voertuig_id' => (int) $data['type_voertuig_id'],
                'type' => trim($data['type']),
                'bouwjaar' => $bouwjaar,
                'brandstof' => $data['brandstof'],
                'kenteken' => $this->normalizeKenteken($data['kenteken']),
                'datum_gewijzigd' => $now,
            ]);
            $voertuig->save();

            $toewijzing = VoertuigInstructeur::query()
                ->where('voertuig_id', $voertuig->id)
                ->first();

            if ($toewijzing) {
                $toewijzing->instructeur_id = (int) $data['instructeur_id'];
                $toewijzing->datum_gewijzigd = $now;
                $toewijzing->save();
            } else {
                VoertuigInstructeur::query()->create([
                    'voertuig_id' => $voertuig->id,
                    'instructeur_id' => (int) $data['instructeur_id'],
                    'datum_toekenning' => Carbon::today()->toDateString(),
                    'is_actief' => true,
                    'opmerking' => 'Automatisch toegewezen via wijzigformulier',
                    'datum_aangemaakt' => $now,
                    'datum_gewijzigd' => $now,
                ]);
            }

            if (DB::connection()->getDriverName() === 'mysql') {
                try {
                    DB::statement('CALL sp_sync_voertuig_datumgewijzigd(?)', [$voertuig->id]);
                } catch (\Throwable) {
                    // Procedure kan ontbreken in ontwikkelomgeving; update blijft geldig.
                }
            }

            return $voertuig->fresh(['typeVoertuig', 'toewijzing.instructeur']);
        });
    }
}
