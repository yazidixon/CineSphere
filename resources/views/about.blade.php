@extends('layouts.app')

@section('title', 'À propos - Cinesphere')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">À propos</h1>
    <p class="home-desc">Cinesphere est une plateforme dédiée aux passionnés de cinéma : découvrez des films, notez-les et partagez vos avis avec la communauté.</p>
    <ul style="list-style:none;padding:0;margin:2rem 0 0 0;text-align:left;">
        <li style="margin-bottom:1.2rem;"><strong>Explorer :</strong> parcourez le catalogue et filtrez par genre.</li>
        <li style="margin-bottom:1.2rem;"><strong>Noter :</strong> donnez une note sur 10 à chaque film.</li>
        <li><strong>Commenter :</strong> partagez votre avis et votez pour les commentaires des autres.</li>
    </ul>
    <a href="{{ route('movies.index') }}" class="home-btn" style="margin-top:2rem;display:inline-block;">Voir les films</a>
</div>
@endsection
