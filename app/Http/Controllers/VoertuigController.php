<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use App\Models\TypeVoertuig;
use App\Models\Voertuig;
use App\Services\VoertuigService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoertuigController extends Controller
{
    public function byInstructor(Instructeur $instructeur): View
    {
        $voertuigen = Voertuig::query()
            ->with(['typeVoertuig', 'toewijzing'])
            ->whereHas('toewijzing', function ($query) use ($instructeur): void {
                $query->where('instructeur_id', $instructeur->id);
            })
            ->join('type_voertuigs', 'type_voertuigs.id', '=', 'voertuigs.type_voertuig_id')
            ->orderBy('type_voertuigs.rijbewijscategorie')
            ->orderBy('voertuigs.type')
            ->select('voertuigs.*')
            ->paginate(4)
            ->withQueryString();

        return view('voertuigen.index', compact('instructeur', 'voertuigen'));
    }

    public function available(Instructeur $instructeur): View
    {
        $voertuigen = Voertuig::query()
            ->with('typeVoertuig')
            ->whereDoesntHave('toewijzing')
            ->join('type_voertuigs', 'type_voertuigs.id', '=', 'voertuigs.type_voertuig_id')
            ->orderBy('type_voertuigs.rijbewijscategorie')
            ->orderBy('voertuigs.type')
            ->select('voertuigs.*')
            ->paginate(4)
            ->withQueryString();

        return view('voertuigen.available', compact('instructeur', 'voertuigen'));
    }

    public function edit(Instructeur $instructeur, Voertuig $voertuig): View
    {
        $voertuig->load('toewijzing');

        $instructeurs = Instructeur::query()
            ->where('is_actief', true)
            ->orderBy('voornaam')
            ->orderBy('achternaam')
            ->get();

        $typeVoertuigen = TypeVoertuig::query()->orderBy('rijbewijscategorie')->get();

        $selectedInstructeurId = $voertuig->toewijzing->instructeur_id ?? $instructeur->id;
        $isDaf = strtoupper(trim($voertuig->type)) === 'DAF';

        return view('voertuigen.edit', compact(
            'instructeur',
            'voertuig',
            'instructeurs',
            'typeVoertuigen',
            'selectedInstructeurId',
            'isDaf'
        ));
    }

    public function update(
        Request $request,
        Instructeur $instructeur,
        Voertuig $voertuig,
        VoertuigService $voertuigService
    ): RedirectResponse {
        $validated = $request->validate([
            'instructeur_id' => ['required', 'integer', 'exists:instructeurs,id'],
            'type_voertuig_id' => ['required', 'integer', 'exists:type_voertuigs,id'],
            'type' => ['required', 'string', 'min:2', 'max:120'],
            'bouwjaar' => ['required', 'date'],
            'brandstof' => ['required', 'in:Diesel,Benzine,Elektrisch'],
            'kenteken' => ['required', 'string', 'max:15', 'regex:/^[A-Za-z0-9-]+$/'],
        ]);

        $voertuigService->updateVoertuig($voertuig->id, $validated);

        return redirect()
            ->route('instructeurs.voertuigen', $instructeur)
            ->with('status', 'Voertuiggegevens zijn gewijzigd.');
    }
}
