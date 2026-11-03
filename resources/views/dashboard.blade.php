@extends('layouts.app')

@section('title', 'Tableau de bord - Cinesphere')

@section('content')
<div class="home-container">
    <h1 class="home-title">Bienvenue à notre site, {{ Auth::user()->name }} !</h1>
    <p class="home-desc">Vous êtes maintenant connecté à Cinesphere.</p>
</div>
<div class="movies-section">
    <h2 class="movies-title">Films à découvrir</h2>
    <div class="movies-grid">
        <div class="movie-card placeholder">Aucun film pour le moment.<br>Les films s'afficheront ici prochainement.</div>
    </div>
</div>
@endsection 