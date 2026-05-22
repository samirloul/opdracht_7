@extends('layouts.app', ['title' => 'Homepage'])

@section('content')
    <h1>BE-opdracht 07</h1>
    <p class="subtitle">Feature1 - Wijzigen voertuiggegevens (Laravel MVC + OOP + PDO)</p>

    <div class="row">
        <a class="btn" href="{{ route('instructeurs.index') }}">Ga naar Instructeurs in dienst</a>
        <a class="btn secondary" href="{{ route('allergenen.index') }}">Ga naar Overzicht allergenen</a>
    </div>
@endsection
