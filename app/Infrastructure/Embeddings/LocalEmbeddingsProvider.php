<?php
namespace App\Infrastructure\Embeddings;

use App\Application\Contracts\EmbeddingsProvider;

class LocalEmbeddingsProvider implements EmbeddingsProvider
{
    public function embed(string $text, string $locale = 'en'): array
    {
        // Deterministic simple embedding placeholder (hash-based)
        $hash = hash('sha256', $locale.'|'.$text);
        $vec = [];
        for ($i = 0; $i < 64; $i++) {
            $byte = hexdec(substr($hash, $i, 1));
            $vec[] = ($byte / 15.0) * 2 - 1; // [-1,1]
        }
        return $vec;
    }
}
