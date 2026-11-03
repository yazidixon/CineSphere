@extends('layouts.app')

@section('title', 'Mon profil - Cinesphere')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Mon profil</h1>
    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}" class="auth-form">
        @csrf
        <label>Nom :</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        <label>Email :</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        <button type="submit" class="home-btn">Mettre à jour</button>
    </form>
    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');" style="margin-top:2rem;">
        @csrf
        @method('DELETE')
        <button type="submit" class="home-btn secondary" style="background:#c41e00;color:#fff;border:none;">Supprimer mon compte</button>
    </form>
    <hr style="margin:2.5rem 0;">
    <h2 style="color:#F53003;">Modifier le mot de passe</h2>
    @if(session('success'))
        <div class="flash-message">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('profile.password') }}" class="auth-form" style="max-width:400px;margin:auto;">
        @csrf
        <label for="current_password">Mot de passe actuel</label>
        <input type="password" name="current_password" id="current_password" required>
        <label for="password">Nouveau mot de passe</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <button type="submit" class="home-btn">Modifier le mot de passe</button>
    </form>
</div>
@endsection 