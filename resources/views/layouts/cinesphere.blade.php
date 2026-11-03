<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinesphere')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
</head>
<body>
    <header class="cinesphere-header">
        <span class="brand">Cinesphere</span>
        @auth
        <div class="user-menu">
            <div class="user-icon" aria-label="Menu utilisateur" title="Menu utilisateur">
                <!-- SVG user icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#F53003"/>
                    <path d="M12 12.5c1.933 0 3.5-1.567 3.5-3.5S13.933 5.5 12 5.5 8.5 7.067 8.5 9s1.567 3.5 3.5 3.5zm0 1.5c-2.333 0-7 1.167-7 3.5V20h14v-2.5c0-2.333-4.667-3.5-7-3.5z" fill="#fff"/>
                </svg>
            </div>
            <div class="user-dropdown">
                <a href="{{ route('profile.show') }}">Modifier le profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            </div>
        </div>
        @endauth
    </header>
    @if (session('success'))
        <div class="flash-message">{{ session('success') }}</div>
    @endif
    <main>
        @yield('content')
    </main>
</body>
</html> 