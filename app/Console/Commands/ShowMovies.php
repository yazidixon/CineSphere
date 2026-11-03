<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;

class ShowMovies extends Command
{
    protected $signature = 'movies:show';
    protected $description = 'Affiche le nombre de films et les premiers films présents dans la base';

    public function handle()
    {
        $count = Movie::count();
        $this->info("Nombre de films : $count");
        foreach (Movie::take(10)->get() as $movie) {
            $this->line($movie->title . ' | ' . $movie->image_name);
        }
    }
} 