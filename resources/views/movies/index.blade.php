@extends('layouts.app')

@section('title', 'Films - Cinesphere')

@section('content')
<div class="movies-section">
    <h2 class="movies-title">Films à l'affiche</h2>
    <!-- Bouton filtre mobile -->
    <button id="openFilterBtn" class="filter-menu-btn" aria-label="Filtres" type="button">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="#F53003"><path d="M3 5h18v2H3V5zm2 7h14v2H5v-2zm4 7h6v2H9v-2z"/></svg>
    </button>
    <!-- Drawer filtres mobile -->
    <div id="filterDrawer" class="filter-drawer">
        <button id="closeFilterBtn" class="close-filter-btn" aria-label="Fermer">&times;</button>
        <form method="GET" action="{{ route('movies.index') }}" class="movies-filter-form" style="margin-top:2em;">
            <input type="text" name="search" placeholder="Rechercher un film..." value="{{ request('search') }}">
            <select name="genre" onchange="this.form.submit()">
                <option value="">Tous les genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}" @if(request('genre') == $genre) selected @endif>{{ $genre }}</option>
                @endforeach
            </select>
            <input type="number" name="year" placeholder="Année du film" value="{{ request('year') }}" min="1900">
            <button type="submit" class="home-btn">Filtrer</button>
        </form>
    </div>
    <div id="filterOverlay" class="filter-overlay"></div>
    <!-- Formulaire filtres desktop -->
    <form method="GET" action="{{ route('movies.index') }}" class="movies-filter-form movies-filter-form-desktop">
        <input type="text" name="search" placeholder="Rechercher un film..." value="{{ request('search') }}">
        <select name="genre" onchange="this.form.submit()">
            <option value="">Tous les genres</option>
            @foreach($genres as $genre)
                <option value="{{ $genre }}" @if(request('genre') == $genre) selected @endif>{{ $genre }}</option>
            @endforeach
        </select>
        <input type="number" name="year" placeholder="Année du film" value="{{ request('year') }}" min="1900">
        <button type="submit" class="home-btn">Filtrer</button>
    </form>
    <div class="movies-grid">
        @forelse($movies as $movie)
            <div class="movie-card">
                @php
                    $imageMap = [
                        '1750951655_prisoners' => '1750951655_prisoners',
                        '1750953504_prisoners' => '1750953504_prisoners',
                        'avatar' => 'avatar',
                        'budapesthotel' => 'budapesthotel',
                        'Darkknight' => 'Darkknight',
                        'exorcist' => 'exorcist',
                        'fight club' => 'fight club',
                        'forrestgump' => 'forrestgump',
                        'getout' => 'getout',
                        'hangover' => 'hangover',
                        'inception' => 'inception',
                        'indianajones' => 'indianajones',
                        'interstellar' => 'interstellar',
                        'jurassicpark' => 'jurassicpark',
                        'lalaland' => 'lalaland',
                        'lionking' => 'lionking',
                        'madmax' => 'madmax',
                        'matrix' => 'matrix',
                        'notebook' => 'notebook',
                        'parasite' => 'parasite',
                        'parrain' => 'parrain',
                        'pulpfiction' => 'pulpfiction',
                        'shawshankredemption' => 'shawshankredemption',
                        'shining' => 'shining',
                        'silenceoflambs' => 'silenceoflambs',
                        'superbad' => 'superbad',
                        'tianic' => 'tianic',
                        'toystory' => 'toystory',
                    ];
                    $imageName = isset($imageMap[$movie->title]) ? $imageMap[$movie->title] . '.jpg' : 'default.jpg';
                @endphp
                <a href="{{ route('movies.show', $movie) }}">
                    <img src="{{ asset('Imagess/' . $movie->image_name . '.jpg') }}" alt="Affiche {{ $movie->title }}" class="movie-poster">
                </a>
                <div>
                    <a href="{{ route('movies.show', $movie) }}" style="text-decoration:none;">
                        <h2 class="movie-title">{{ $movie->title }}</h2>
                    </a>
                    <div style="color:#fff;font-weight:bold;margin:0.3em 0 0.7em 0;">({{ $movie->year }})</div>
                    {{-- <div style="color:#e0e0e0;font-size:1em;margin-bottom:0.7em;line-height:1.4;">
                        {{ \Illuminate\Support\Str::limit($movie->description, 150, '...') }}
                    </div> --}}
                </div>
            </div>
        @empty
            <div class="movie-card placeholder">Aucun film pour le moment.</div>
        @endforelse
    </div>
    @auth
    @if(auth()->user()->role === 'admin')
    <div style="text-align:right;margin-top:2rem;">
        <a href="{{ route('movies.create') }}" class="home-btn">Ajouter un film</a>
    </div>
    @endif
    @endauth
</div>

{{-- @foreach($movies as $movie)
    <div style="color:red;font-weight:bold;">Titre film : {{ $movie->title }}</div>
@endforeach --}}
@endsection 