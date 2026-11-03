@extends('layouts.app')

@section('title', $movie->title . ' - Cinesphere')

@section('content')
<div class="movies-section">
    @php
        $imageMap = [
            '1750951655_prisoners' => '1750951655_prisoners',
            '1750953504_prisoners' => '1750953504_prisoners',
            'avatar' => 'avatar',
            'budapesthotel' => 'budapesthotel',
            'Darkknight' => 'Darkknight',
            'exorcist' => 'exorcist',
            'fight club' => 'fight club',
            'forrestgump' => 'forrestgump',
            'getout' => 'getout',
            'hangover' => 'hangover',
            'inception' => 'inception',
            'indianajones' => 'indianajones',
            'interstellar' => 'interstellar',
            'jurassicpark' => 'jurassicpark',
            'lalaland' => 'lalaland',
            'lionking' => 'lionking',
            'madmax' => 'madmax',
            'matrix' => 'matrix',
            'notebook' => 'notebook',
            'parasite' => 'parasite',
            'parrain' => 'parrain',
            'pulpfiction' => 'pulpfiction',
            'shawshankredemption' => 'shawshankredemption',
            'shining' => 'shining',
            'silenceoflambs' => 'silenceoflambs',
            'superbad' => 'superbad',
            'tianic' => 'tianic',
            'toystory' => 'toystory',
        ];
        $imageName = isset($imageMap[$movie->title]) ? $imageMap[$movie->title] . '.jpg' : 'default.jpg';
    @endphp
    <div class="movie-detail-title">{{ $movie->title }}</div>
    <img src="{{ asset('Imagess/' . $movie->image_name . '.jpg') }}" alt="Affiche {{ $movie->title }}" class="movie-poster-large">
    <h2 class="movies-title">{{ $movie->title }} <span class="movie-year">({{ $movie->year }})</span></h2>
    <div class="movie-description-box" style="background:#23263A;border-radius:14px;padding:1.2em 1.3em;margin-bottom:1.5em;box-shadow:0 2px 12px #0003;max-width:600px;">
        <div style="display:flex;align-items:center;gap:0.5em;margin-bottom:0.5em;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#F53003" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-7h2v5h-2zm0-6h2v2h-2z"/></svg>
            <span style="font-weight:700;font-size:1.13em;color:#fff;">À propos du film</span>
        </div>
        <div style="color:#e0e0e0;font-size:1.08em;line-height:1.6;">{{ $movie->description }}</div>
    </div>
    <a href="{{ route('movies.index') }}" class="home-btn secondary">Retour à la liste</a>
    <hr>
    <h3>Note du film</h3>
    <div class="movie-rating-box">
        <div class="movie-rating-average" style="display:flex;align-items:center;gap:0.5em;font-size:1.13em;">
            <strong>NOTE :</strong>
            <span style="color:#FFD600;">{{ $movie->averageRating() ?? 'Pas encore de note' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#FFD600" style="vertical-align:middle;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            <span style="color:#aaa;font-size:0.95em;">/ 10</span>
        </div>
        @auth
            <form method="POST" action="{{ route('movies.rate', $movie->id) }}" class="movie-rating-form">
                @csrf
                <label for="rating" style="display:flex;align-items:center;gap:0.4em;font-weight:600;">
                    Noter
                </label>
                <input type="number" name="rating" id="rating" min="0" max="10" step="0.1" value="{{ optional($movie->ratings()->where('user_id', auth()->id())->first())->rating }}" required>
                <button type="submit" class="home-btn" style="padding:0.5em 0.7em;min-width:0;" title="Noter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="#111" style="vertical-align:middle;"><path d="M2 21l21-9-21-9v7l15 2-15 2z"/></svg>
                </button>
            </form>
        @endauth
    </div>
    <h3>Commentaires</h3>
    <div class="comments-list">
        @forelse($movie->comments()->latest()->get() as $comment)
            <div class="comment-card">
                <strong>{{ $comment->user->name }}</strong> <span class="comment-date">({{ $comment->created_at->format('d/m/Y H:i') }})</span><br>
                {{ $comment->content }}
                <div class="comment-votes">
                    <form method="POST" action="{{ route('comments.vote', $comment->id) }}">
                        @csrf
                        <input type="hidden" name="type" value="like">
                        <button type="submit" class="vote-btn like">👍 <span>{{ $comment->votes()->where('type','like')->count() }}</span></button>
                    </form>
                    <form method="POST" action="{{ route('comments.vote', $comment->id) }}">
                        @csrf
                        <input type="hidden" name="type" value="dislike">
                        <button type="submit" class="vote-btn dislike">👎 <span>{{ $comment->votes()->where('type','dislike')->count() }}</span></button>
                    </form>
                </div>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" class="comment-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="home-btn secondary comment-delete-btn">Supprimer</button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <div class="comment-card placeholder">Aucun commentaire pour ce film.</div>
        @endforelse
    </div>
    @auth
        <form method="POST" action="{{ route('comments.store', $movie->id) }}" class="comment-form" style="display:flex;align-items:center;gap:0.7em;max-width:420px;">
            @csrf
            <textarea name="content" rows="2" placeholder="Votre avis ou commentaire..." required style="resize:none;min-width:0;width:100%;max-width:320px;height:2.5em;font-size:1.05em;"></textarea>
            <button type="submit" class="home-btn" title="Publier" style="padding:0.5em 0.7em;min-width:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="#111" style="vertical-align:middle;"><path d="M2 21l21-9-21-9v7l15 2-15 2z"/></svg>
            </button>
        </form>
    @endauth
    @auth
        @if(auth()->user()->role === 'admin')
        <div class="movie-admin-actions">
            <a href="{{ route('movies.edit', $movie->id) }}" class="home-btn secondary">Modifier</a>
            <form method="POST" action="{{ route('movies.destroy', $movie->id) }}">
                @csrf
                <button type="submit" class="home-btn secondary">Supprimer</button>
            </form>
        </div>
        @endif
    @endauth
</div>
@endsection 