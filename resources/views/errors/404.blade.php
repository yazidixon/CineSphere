@extends('layouts.app')

@section('title', 'Page non trouvée - Cinesphere')

@section('content')
<div class="home-container">
    <h1 class="home-title">404</h1>
    <p class="home-desc">Oups ! La page que vous cherchez n'existe pas.</p>
    <a href="{{ route('home') }}" class="home-btn">Retour à l'accueil</a>
</div>
@endsection 