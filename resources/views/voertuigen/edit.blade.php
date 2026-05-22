@extends('layouts.app', ['title' => 'Wijzigen voertuiggegevens'])

@section('content')
    <h1>Wijzigen voertuiggegevens</h1>
    <p class="subtitle">Voertuig: {{ $voertuig->type }} ({{ $voertuig->kenteken }})</p>

    @if($errors->any())
        <div class="errors">
            <strong>Controleer het formulier:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('instructeurs.voertuigen.update', [$instructeur, $voertuig]) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="field">
                <label for="instructeur_id">Instructeur</label>
                <select name="instructeur_id" id="instructeur_id" required>
                    @foreach($instructeurs as $item)
                        <option value="{{ $item->id }}" @selected((int) old('instructeur_id', $selectedInstructeurId) === (int) $item->id)>
                            {{ trim($item->voornaam . ' ' . $item->tussenvoegsel . ' ' . $item->achternaam) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="type_voertuig_id">Type voertuig</label>
                <select name="type_voertuig_id" id="type_voertuig_id" required>
                    @foreach($typeVoertuigen as $typeVoertuig)
                        <option value="{{ $typeVoertuig->id }}" @selected((int) old('type_voertuig_id', $voertuig->type_voertuig_id) === (int) $typeVoertuig->id)>
                            {{ $typeVoertuig->type_voertuig }} ({{ $typeVoertuig->rijbewijscategorie }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label for="type">Type</label>
                <input type="text" id="type" name="type" value="{{ old('type', $voertuig->type) }}" required>
            </div>

            <div class="field">
                <label for="bouwjaar">Bouwjaar</label>
                <input
                    type="date"
                    id="bouwjaar"
                    name="bouwjaar"
                    value="{{ old('bouwjaar', optional($voertuig->bouwjaar)->format('Y-m-d')) }}"
                    @if($isDaf) readonly @endif
                    required
                >
                @if($isDaf)
                    <small>Bouwjaar is readonly voor type DAF (scenario 04).</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Brandstof</label>
                <div class="radio-group">
                    @php $selectedBrandstof = old('brandstof', $voertuig->brandstof); @endphp
                    @foreach(['Diesel', 'Benzine', 'Elektrisch'] as $brandstof)
                        <label>
                            <input type="radio" name="brandstof" value="{{ $brandstof }}" @checked($selectedBrandstof === $brandstof)>
                            {{ $brandstof }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="field">
                <label for="kenteken">Kenteken</label>
                <input type="text" id="kenteken" name="kenteken" value="{{ old('kenteken', $voertuig->kenteken) }}" required>
            </div>
        </div>

        <p>
            <button class="btn" type="submit">Wijzig</button>
            <a class="btn secondary" href="{{ route('instructeurs.voertuigen', $instructeur) }}">Annuleren</a>
        </p>
    </form>
@endsection
