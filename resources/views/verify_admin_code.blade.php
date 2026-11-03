@extends('layouts.app')

@section('title', 'Vérification code admin')

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Devenir administrateur</h1>
    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="color:red;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('admin.verify_code') }}">
        @csrf
        <label for="admin_code">Code admin :</label>
        <input type="text" name="admin_code" id="admin_code" required>
        <button type="submit">Valider</button>
    </form>
</div>
@endsection 