<?php
namespace App\Application\Contracts;

interface EmbeddingsProvider
{
    /**
     * @param string $text
     * @param string $locale
     * @return array<float>
     */
    public function embed(string $text, string $locale = 'en'): array;
}
