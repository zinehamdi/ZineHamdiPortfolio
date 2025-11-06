<?php
namespace App\Infrastructure\Repositories;

use App\Application\Repositories\ContentChunkRepository;
use App\Models\ContentChunk;

class EloquentContentChunkRepository implements ContentChunkRepository
{
    public function upsert(ContentChunk $chunk): void
    {
        ContentChunk::updateOrCreate(
            ['slug' => $chunk->slug, 'locale' => $chunk->locale],
            $chunk->only(['title','body','vector'])
        );
    }

    public function topKSimilar(array $queryVector, string $locale, int $k = 5): array
    {
        $chunks = ContentChunk::where('locale', $locale)->get();
        $scored = $chunks->map(function ($c) use ($queryVector) {
            $v = (array) $c->vector;
            $score = $this->cosine($queryVector, $v);
            return ['chunk' => $c, 'score' => $score];
        })->sortByDesc('score')->take($k)->pluck('chunk')->all();
        return $scored;
    }

    private function cosine(array $a, array $b): float
    {
        $dot = 0; $na = 0; $nb = 0; $n = min(count($a), count($b));
        for ($i = 0; $i < $n; $i++) { $dot += $a[$i]*$b[$i]; $na += $a[$i]*$a[$i]; $nb += $b[$i]*$b[$i]; }
        if ($na == 0 || $nb == 0) return 0.0;
        return $dot / (sqrt($na) * sqrt($nb));
    }
}
