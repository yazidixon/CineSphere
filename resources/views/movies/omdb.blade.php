@extends('layouts.app')

@section('title', 'Recherche OMDb')

@section('content')
    <h2>Recherche de film (OMDb)</h2>
    <form method="GET" action="{{ route('omdb.search') }}">
        <input type="text" name="title" placeholder="Titre du film" value="{{ $title ?? '' }}">
        <button type="submit">Rechercher</button>
    </form>

    @if($movie)
        @if(isset($movie['Response']) && $movie['Response'] == 'True')
            <div style="margin-top:2rem;">
                <h3>{{ $movie['Title'] }} ({{ $movie['Year'] }})</h3>
                <img src="{{ $movie['Poster'] }}" alt="Affiche" style="max-width:200px;">
                <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
                <p><strong>Réalisateur:</strong> {{ $movie['Director'] }}</p>
                <p><strong>Résumé:</strong> {{ $movie['Plot'] }}</p>
            </div>
        @else
            <div style="color:red;margin-top:2rem;">Aucun film trouvé.</div>
        @endif
    @endif
@endsection 