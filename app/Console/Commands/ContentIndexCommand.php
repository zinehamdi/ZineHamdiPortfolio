<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ContentChunk;
use App\Application\Contracts\EmbeddingsProvider;

class ContentIndexCommand extends Command
{
    protected $signature = 'content:index {--locale=en}';
    protected $description = 'Index services/packages/blog content into embeddings.';

    public function handle(EmbeddingsProvider $embed)
    {
        $locale = $this->option('locale');
        $this->info("Indexing content for locale: {$locale}");

        $contents = [
            ['title' => 'Services Overview', 'slug' => 'services-overview', 'body' => 'We offer Starter, Pro, and Enterprise plans.'],
            ['title' => 'Pricing', 'slug' => 'pricing', 'body' => 'Transparent pricing with clear features.'],
            ['title' => 'Blog Intro', 'slug' => 'blog-intro', 'body' => 'Insights on Laravel, Tailwind, and Clean Architecture.'],
        ];

        foreach ($contents as $c) {
            $vec = $embed->embed($c['title'].' '.$c['body'], $locale);
            ContentChunk::updateOrCreate(
                ['slug' => $c['slug'], 'locale' => $locale],
                ['title' => $c['title'], 'body' => $c['body'], 'vector' => $vec]
            );
        }

        $this->info('Indexing complete.');
        return self::SUCCESS;
    }
}
