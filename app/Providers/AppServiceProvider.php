<?php

namespace App\Providers;

use App\Application\Contracts\EmbeddingsProvider;
use App\Infrastructure\Embeddings\LocalEmbeddingsProvider;
use App\Application\Repositories\ContentChunkRepository;
use App\Infrastructure\Repositories\EloquentContentChunkRepository;
use App\Application\Contracts\CrmClient;
use App\Infrastructure\Crm\FakeCrmClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmbeddingsProvider::class, LocalEmbeddingsProvider::class);
        $this->app->bind(ContentChunkRepository::class, EloquentContentChunkRepository::class);
        $this->app->bind(CrmClient::class, FakeCrmClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
