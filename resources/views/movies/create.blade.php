@extends('layouts.app')

@section('title', 'Ajouter un film - Cinesphere')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Ajouter un film</h1>
    <form method="POST" action="{{ route('movies.store') }}" class="auth-form movie-form" enctype="multipart/form-data">
        @csrf
        <label>Titre :</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
        <label>Description :</label>
        <textarea name="description" required>{{ old('description') }}</textarea>
        <label>Année :</label>
        <input type="number" name="year" value="{{ old('year') }}" required>
        <label>Genre :</label>
        <select name="genre" required>
            <option value="">Choisir un genre</option>
            <option value="Action">Action</option>
            <option value="Aventure">Aventure</option>
            <option value="Comédie">Comédie</option>
            <option value="Drame">Drame</option>
            <option value="Science-fiction">Science-fiction</option>
            <option value="Horreur">Horreur</option>
            <option value="Animation">Animation</option>
            <option value="Romance">Romance</option>
            <option value="Thriller">Thriller</option>
            <option value="Documentaire">Documentaire</option>
        </select>
        <label>Image :</label>
        <input type="file" name="image" accept="image/*">
        <label>Réalisateur :</label>
        <input type="text" name="director" value="{{ old('director') }}">
        <label>Acteurs (séparés par des virgules) :</label>
        <input type="text" name="actors" value="{{ old('actors') }}">
        <label>Pays :</label>
        <input type="text" name="country" value="{{ old('country') }}">
        <label>Durée (en minutes) :</label>
        <input type="number" name="duration" value="{{ old('duration') }}" min="1">
        <button type="submit" class="home-btn">Ajouter</button>
    </form>
</div>
@endsection 