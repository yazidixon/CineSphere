<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Movie;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $movie = Movie::findOrFail($id);
        $comment = new Comment([
            'content' => $request->input('content'),
        ]);
        $comment->user_id = auth()->id();
        $comment->movie_id = $movie->id;
        $comment->save();
        return redirect()->route('movies.show', $movie->id)->with('success', 'Commentaire ajouté !');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé');
        }
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé !');
    }

    public function vote(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);
        $comment = \App\Models\Comment::findOrFail($id);
        $user = auth()->user();
        $vote = \App\Models\CommentVote::firstOrNew([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
        ]);
        $vote->type = $request->type;
        $vote->save();
        return back();
    }
} 