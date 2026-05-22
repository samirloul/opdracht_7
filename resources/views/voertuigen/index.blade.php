@extends('layouts.app', ['title' => 'Door instructeur gebruikte voertuigen'])

@section('content')
    <h1>Door instructeur gebruikte voertuigen</h1>
    <p class="subtitle">{{ $instructeur->voornaam }} {{ $instructeur->tussenvoegsel }} {{ $instructeur->achternaam }}</p>

    @if(session('status'))
        <div class="notice">{{ session('status') }}</div>
    @endif

    <p>
        <a class="btn secondary" href="{{ route('instructeurs.voertuigen.available', $instructeur) }}">Toevoegen voertuig</a>
    </p>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Type voertuig</th>
                <th>Type</th>
                <th>Kenteken</th>
                <th>Bouwjaar</th>
                <th>Brandstof</th>
                <th>Rijbewijscategorie</th>
                <th>Wijzigen</th>
            </tr>
            </thead>
            <tbody>
            @forelse($voertuigen as $voertuig)
                <tr>
                    <td>{{ $voertuig->typeVoertuig->type_voertuig }}</td>
                    <td>{{ $voertuig->type }}</td>
                    <td>{{ $voertuig->kenteken }}</td>
                    <td>{{ optional($voertuig->bouwjaar)->format('d-m-Y') }}</td>
                    <td>{{ $voertuig->brandstof }}</td>
                    <td>{{ $voertuig->typeVoertuig->rijbewijscategorie }}</td>
                    <td class="actions">
                        <a href="{{ route('instructeurs.voertuigen.edit', [$instructeur, $voertuig]) }}">Wijzigen</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Geen voertuigen toegewezen.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $voertuigen->links() }}</div>
@endsection
