@extends('layouts.app')

@section('title', 'Cinesphere - Accueil')

@section('content')
<div class="home-container">
    <h1 class="home-title">Bienvenue sur <span class="logo-accent">Cine</span><span class="logo-light">sphere</span></h1>
    <p class="home-desc">La plateforme ultime pour découvrir, discuter et partager autour du cinéma. Explorez les films, créez votre compte, et plongez dans l'univers du 7<sup>e</sup> art !</p>
    <div class="home-btns">
        <a href="{{ route('movies.index') }}" class="home-btn">Voir les films</a>
        @guest
        <a href="{{ route('register.show') }}" class="home-btn secondary">S'inscrire</a>
        @endguest
    </div>
</div>
@endsection
