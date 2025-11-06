<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Contracts\EmbeddingsProvider;
use App\Infrastructure\Embeddings\LocalEmbeddingsProvider;
use App\Application\Repositories\ContentChunkRepository;
use App\Infrastructure\Repositories\EloquentContentChunkRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmbeddingsProvider::class, LocalEmbeddingsProvider::class);
        $this->app->bind(ContentChunkRepository::class, EloquentContentChunkRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
