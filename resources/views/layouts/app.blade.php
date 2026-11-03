<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinesphere')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="main-header">
        <a href="{{ route('home') }}" class="logo" style="text-decoration:none;">
            Cine<span>sphere</span>
        </a>
        <nav class="main-nav">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('movies.index') }}">Films</a>
            <a href="{{ route('contact') }}">Contact</a>
            <form action="{{ route('movies.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Rechercher un film..." value="{{ request('search') }}">
                <button type="submit" class="nav-btn">🔍</button>
            </form>
            @guest
                <a href="{{ route('login.show') }}" class="nav-btn">Connexion</a>
                <a href="{{ route('register.show') }}" class="nav-btn nav-btn-outline">Inscription</a>
            @else
                <div class="user-menu">
                    <div class="user-icon" aria-label="Menu utilisateur" title="Menu utilisateur">
                        <img src="{{ asset('Imagess/profilelogo.png') }}" alt="Profil" style="width:32px;height:32px;object-fit:cover;display:block;" />
                    </div>
                    <div class="user-dropdown">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('profile.show') }}">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Déconnexion</button>
                        </form>
                    </div>
                </div>
            @endguest
        </nav>
    </header>
    @if (session('success'))
        <div class="flash-message">{{ session('success') }}</div>
    @endif
    <main class="main-content">
        @yield('content')
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userIcon = document.querySelector('.user-icon');
            const userMenu = document.querySelector('.user-menu');
            if (userIcon && userMenu) {
                userIcon.addEventListener('click', function(e) {
                    userMenu.classList.toggle('open');
                    e.stopPropagation();
                });
                document.addEventListener('click', function() {
                    userMenu.classList.remove('open');
                });
            }
        });
    </script>
</body>
</html> 