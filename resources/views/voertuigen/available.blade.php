@extends('layouts.app', ['title' => 'Alle beschikbare voertuigen'])

@section('content')
    <h1>Alle beschikbare voertuigen</h1>
    <p class="subtitle">Nog niet toegewezen aan een instructeur - context: {{ $instructeur->voornaam }} {{ $instructeur->achternaam }}</p>

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
            <tr><td colspan="7">Geen beschikbare voertuigen gevonden.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $voertuigen->links() }}</div>
@endsection
