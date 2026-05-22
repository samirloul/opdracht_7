@extends('layouts.app', ['title' => 'Overzicht allergenen'])

@section('content')
    <h1>Overzicht allergenen</h1>
    <p class="subtitle">Pagination staat op maximaal 4 records per pagina</p>

    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>Omschrijving</th>
        </tr>
        </thead>
        <tbody>
        @forelse($allergenen as $allergeen)
            <tr>
                <td>{{ $allergeen->naam }}</td>
                <td>{{ $allergeen->omschrijving }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Geen allergenen gevonden.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $allergenen->links() }}</div>
@endsection
