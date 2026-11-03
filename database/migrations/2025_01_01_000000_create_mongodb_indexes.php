<?php

use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * MongoDB will create collections automatically on first insert.
     * This migration creates indexes for better performance.
     */
    public function up(): void
    {
        // Create indexes for users collection
        if (Schema::connection('mongodb')->hasCollection('users')) {
            Schema::connection('mongodb')->table('users', function (Blueprint $collection) {
                $collection->index('email', ['unique' => true]);
                $collection->index('name');
            });
        }

        // Create indexes for movies collection
        if (Schema::connection('mongodb')->hasCollection('movies')) {
            Schema::connection('mongodb')->table('movies', function (Blueprint $collection) {
                $collection->index('title');
                $collection->index('genre');
                $collection->index('year');
            });
        }

        // Create indexes for comments collection
        if (Schema::connection('mongodb')->hasCollection('comments')) {
            Schema::connection('mongodb')->table('comments', function (Blueprint $collection) {
                $collection->index('user_id');
                $collection->index('movie_id');
            });
        }

        // Create indexes for ratings collection
        if (Schema::connection('mongodb')->hasCollection('ratings')) {
            Schema::connection('mongodb')->table('ratings', function (Blueprint $collection) {
                $collection->index('user_id');
                $collection->index('movie_id');
                $collection->index(['user_id', 'movie_id'], ['unique' => true]);
            });
        }

        // Create indexes for comment_votes collection
        if (Schema::connection('mongodb')->hasCollection('comment_votes')) {
            Schema::connection('mongodb')->table('comment_votes', function (Blueprint $collection) {
                $collection->index('user_id');
                $collection->index('comment_id');
            });
        }

        // Create indexes for sessions collection (if using database sessions)
        if (Schema::connection('mongodb')->hasCollection('sessions')) {
            Schema::connection('mongodb')->table('sessions', function (Blueprint $collection) {
                $collection->index('id');
                $collection->index('user_id');
                $collection->index('last_activity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: Dropping indexes in MongoDB can be done manually if needed
        // The collections will remain as MongoDB is schemaless
    }
};
