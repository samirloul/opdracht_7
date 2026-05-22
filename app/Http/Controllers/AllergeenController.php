<?php

namespace App\Http\Controllers;

use App\Models\Allergeen;
use Illuminate\Contracts\View\View;

class AllergeenController extends Controller
{
    public function index(): View
    {
        $allergenen = Allergeen::query()
            ->where('is_actief', true)
            ->orderBy('naam')
            ->paginate(4)
            ->withQueryString();

        return view('allergenen.index', compact('allergenen'));
    }
}
