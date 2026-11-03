<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use App\Models\Rating;

class MovieController extends Controller
{
    public function index()
    {
        $query = Movie::query();
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }
        if (request('genre')) {
            $query->where('genre', request('genre'));
        }
        if (request('year')) {
            $query->where('year', request('year'));
        }
        $movies = $query->get();
        $genres = Movie::select('genre')->distinct()->pluck('genre');
        
        return view('movies.index', compact('movies', 'genres'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        return view('movies.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Imagess'), $imageName);
            $validated['image'] = 'Imagess/' . $imageName;
        }

        $movie = Movie::create($validated);
        return redirect()->route('movies.show', $movie->id)->with('success', 'Film ajouté !');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $movie = Movie::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|integer',
            'genre' => 'required|string|max:100',
        ]);
        $movie->update($validated);
        return redirect()->route('movies.show', $movie->id)->with('success', 'Film modifié !');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Film supprimé.');
    }

    public function omdbSearch(Request $request)
    {
        $title = $request->input('title');
        $movie = null;

        if ($title) {
            $response = Http::get('http://www.omdbapi.com/', [
                'apikey' => env('OMDB_API_KEY'),
                't' => $title,
            ]);
            $movie = $response->json();
        }

        return view('movies.omdb', compact('movie', 'title'));
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
        ]);
        $movie = Movie::findOrFail($id);
        $user = auth()->user();
        $rating = Rating::updateOrCreate(
            [
                'user_id' => $user->id,
                'movie_id' => $movie->id,
            ],
            [
                'rating' => $request->input('rating'),
            ]
        );
        return redirect()->route('movies.show', $movie->id)->with('success', 'Votre note a été enregistrée !');
    }
} 