<?php

namespace App\Http\Controllers;

use App\Models\Instructeur;
use Illuminate\Contracts\View\View;

class InstructeurController extends Controller
{
    public function index(): View
    {
        $instructeurs = Instructeur::query()
            ->where('is_actief', true)
            ->orderByDesc('aantal_sterren')
            ->orderBy('achternaam')
            ->paginate(4)
            ->withQueryString();

        return view('instructeurs.index', compact('instructeurs'));
    }
}
