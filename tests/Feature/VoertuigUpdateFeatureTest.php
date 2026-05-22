<?php

namespace Tests\Feature;

use App\Models\Instructeur;
use App\Models\Voertuig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoertuigUpdateFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_vespa_can_be_updated_and_reassigned(): void
    {
        $this->seed();

        $contextInstructeur = Instructeur::query()->findOrFail(5); // Mohammed
        $targetInstructeur = Instructeur::query()->findOrFail(4); // Bert
        $vespa = Voertuig::query()->findOrFail(10);

        $response = $this->put(route('instructeurs.voertuigen.update', [$contextInstructeur, $vespa]), [
            'instructeur_id' => $targetInstructeur->id,
            'type_voertuig_id' => $vespa->type_voertuig_id,
            'type' => 'Vespa Piaggio',
            'bouwjaar' => $vespa->bouwjaar->format('Y-m-d'),
            'brandstof' => 'Elektrisch',
            'kenteken' => 'drs-52-e',
        ]);

        $response->assertRedirect(route('instructeurs.voertuigen', $contextInstructeur));
        $this->assertDatabaseHas('voertuigs', [
            'id' => 10,
            'type' => 'Vespa Piaggio',
            'brandstof' => 'Elektrisch',
            'kenteken' => 'DRS-52-E',
        ]);

        $this->assertDatabaseHas('voertuig_instructeurs', [
            'voertuig_id' => 10,
            'instructeur_id' => 4,
        ]);
    }

    public function test_daf_bouwjaar_stays_unchanged_after_update(): void
    {
        $this->seed();

        $contextInstructeur = Instructeur::query()->findOrFail(5);
        $daf = Voertuig::query()->findOrFail(2);
        $originalBouwjaar = $daf->bouwjaar->format('Y-m-d');

        $response = $this->put(route('instructeurs.voertuigen.update', [$contextInstructeur, $daf]), [
            'instructeur_id' => $contextInstructeur->id,
            'type_voertuig_id' => $daf->type_voertuig_id,
            'type' => 'DAF',
            'bouwjaar' => '2025-01-01',
            'brandstof' => 'Diesel',
            'kenteken' => $daf->kenteken,
        ]);

        $response->assertRedirect(route('instructeurs.voertuigen', $contextInstructeur));
        $daf->refresh();
        $this->assertSame($originalBouwjaar, $daf->bouwjaar->format('Y-m-d'));
    }
}
