@extends('layouts.app')

@section('title', 'Modifier le film - Cinesphere')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Modifier le film</h1>
    <form method="POST" action="{{ route('movies.update', $movie->id) }}" class="auth-form movie-form">
        @csrf
        <label>Titre :</label>
        <input type="text" name="title" value="{{ old('title', $movie->title) }}" required>
        <label>Description :</label>
        <textarea name="description" required>{{ old('description', $movie->description) }}</textarea>
        <label>Année :</label>
        <input type="number" name="year" value="{{ old('year', $movie->year) }}" required>
        <label>Genre :</label>
        <select name="genre" required>
            <option value="">Choisir un genre</option>
            <option value="Action" @if(old('genre', $movie->genre) == 'Action') selected @endif>Action</option>
            <option value="Aventure" @if(old('genre', $movie->genre) == 'Aventure') selected @endif>Aventure</option>
            <option value="Comédie" @if(old('genre', $movie->genre) == 'Comédie') selected @endif>Comédie</option>
            <option value="Drame" @if(old('genre', $movie->genre) == 'Drame') selected @endif>Drame</option>
            <option value="Science-fiction" @if(old('genre', $movie->genre) == 'Science-fiction') selected @endif>Science-fiction</option>
            <option value="Horreur" @if(old('genre', $movie->genre) == 'Horreur') selected @endif>Horreur</option>
            <option value="Animation" @if(old('genre', $movie->genre) == 'Animation') selected @endif>Animation</option>
            <option value="Romance" @if(old('genre', $movie->genre) == 'Romance') selected @endif>Romance</option>
            <option value="Thriller" @if(old('genre', $movie->genre) == 'Thriller') selected @endif>Thriller</option>
            <option value="Documentaire" @if(old('genre', $movie->genre) == 'Documentaire') selected @endif>Documentaire</option>
        </select>
        <label>Réalisateur :</label>
        <input type="text" name="director" value="{{ old('director', $movie->director) }}">
        <label>Acteurs (séparés par des virgules) :</label>
        <input type="text" name="actors" value="{{ old('actors', $movie->actors) }}">
        <label>Pays :</label>
        <input type="text" name="country" value="{{ old('country', $movie->country) }}">
        <label>Durée (en minutes) :</label>
        <input type="number" name="duration" value="{{ old('duration', $movie->duration) }}" min="1">
        <button type="submit" class="home-btn">Mettre à jour</button>
    </form>
</div>
@endsection 