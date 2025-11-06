<?php
namespace App\Application\Repositories;

use App\Models\ContentChunk;

interface ContentChunkRepository
{
    public function upsert(ContentChunk $chunk): void;
    /** @return ContentChunk[] */
    public function topKSimilar(array $queryVector, string $locale, int $k = 5): array;
}
