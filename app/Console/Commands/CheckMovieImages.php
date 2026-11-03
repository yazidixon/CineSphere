<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;

class CheckMovieImages extends Command
{
    protected $signature = 'movies:check-images';
    protected $description = 'Vérifie la présence des images pour chaque film dans public/Imagess/';

    public function handle()
    {
        $missing = [];
        foreach (Movie::all() as $movie) {
            $imagePath = public_path('Imagess/' . $movie->image_name . '.jpg');
            if (!file_exists($imagePath)) {
                $missing[] = $movie->title . ' => ' . $movie->image_name . '.jpg';
            }
        }
        if (empty($missing)) {
            $this->info('Toutes les images sont présentes.');
        } else {
            $this->error('Images manquantes pour les films suivants :');
            foreach ($missing as $miss) {
                $this->line($miss);
            }
        }
    }
} 