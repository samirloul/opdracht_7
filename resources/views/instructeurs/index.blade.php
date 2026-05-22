@extends('layouts.app', ['title' => 'Instructeurs in dienst'])

@section('content')
    <h1>Instructeurs in dienst</h1>
    <p class="subtitle">Gesorteerd op aantal sterren aflopend</p>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Mobiel</th>
                <th>Datum in dienst</th>
                <th>Aantal sterren</th>
                <th>Voertuigen</th>
            </tr>
            </thead>
            <tbody>
            @forelse($instructeurs as $instructeur)
                <tr>
                    <td>{{ $instructeur->voornaam }}</td>
                    <td>{{ $instructeur->tussenvoegsel }}</td>
                    <td>{{ $instructeur->achternaam }}</td>
                    <td>{{ $instructeur->mobiel }}</td>
                    <td>{{ optional($instructeur->datum_in_dienst)->format('d-m-Y') }}</td>
                    <td>{{ str_repeat('*', (int) $instructeur->aantal_sterren) }}</td>
                    <td class="actions">
                        <a href="{{ route('instructeurs.voertuigen', $instructeur) }}">Voertuigen</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Geen instructeurs gevonden.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">{{ $instructeurs->links() }}</div>
@endsection
