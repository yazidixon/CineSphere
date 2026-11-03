@extends('layouts.app')

@section('title', 'Inscription - Cinesphere')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Inscription</h1>
    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register.perform') }}" class="auth-form">
        @csrf
        <label>Nom :</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <label>Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <label>Confirmer le mot de passe :</label>
        <input type="password" name="password_confirmation" required>
        <label for="phone">Numéro de téléphone</label>
        <input type="tel" name="phone" id="phone" required pattern="[0-9\s\-\+]{8,20}" placeholder="Votre numéro de téléphone">
        <label for="role" style="margin-top:1rem;font-weight:600;">Rôle :</label>
        <select name="role" id="role" required onchange="toggleAdminCode()">
            <option value="user" @if(old('role')=='user') selected @endif>Utilisateur</option>
            <option value="admin" @if(old('role')=='admin') selected @endif>Admin</option>
        </select>
        <div id="admin-code-field" style="display:none;margin-top:10px;">
            <label for="admin_code">Code admin (reçu par mail) :</label>
            <input type="text" name="admin_code" id="admin_code" value="{{ old('admin_code') }}">
        </div>
        <script>
            function toggleAdminCode() {
                var role = document.getElementById('role').value;
                document.getElementById('admin-code-field').style.display = (role === 'admin') ? 'block' : 'none';
            }
            document.addEventListener('DOMContentLoaded', function() {
                toggleAdminCode();
            });
        </script>
        <button type="submit" class="home-btn">S'inscrire</button>
    </form>
</div>
@endsection
