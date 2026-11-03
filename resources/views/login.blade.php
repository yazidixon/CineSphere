@extends('layouts.app')

@section('title', "S'authentifier - Cinesphere")

@section('content')
<div class="auth-container">
    <h1 class="auth-title">S'authentifier</h1>
    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.perform') }}" class="auth-form">
        @csrf
        <label>Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit" class="home-btn">S'authentifier</button>
    </form>
</div>
@endsection 