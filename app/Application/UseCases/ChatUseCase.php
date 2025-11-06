<?php
namespace App\Application\UseCases;

use App\Application\Contracts\EmbeddingsProvider;
use App\Application\Repositories\ContentChunkRepository;

class ChatUseCase
{
    public function __construct(
        private EmbeddingsProvider $embeddings,
        private ContentChunkRepository $repo
    ) {}

    public function answer(string $message, string $locale = 'en'): array
    {
        $qv = $this->embeddings->embed($message, $locale);
        $top = $this->repo->topKSimilar($qv, $locale, 5);
        $context = collect($top)->map(fn($c) => "- {$c->title}: {$c->body}")->join("\n");
        $system = match($locale) {
            'ar' => 'أجب بإيجاز وبنقاط. استشهد بالمقاطع ذات الصلة. اللغة العربية.',
            'fr' => 'Réponds brièvement en puces. Cite les extraits pertinents. Langue française.',
            default => 'Answer briefly in bullet points. Cite relevant snippets. English.',
        };
        // Placeholder LLM call: echo back a response based on context
        $answer = $system."\n\n".'Context:'."\n".$context."\n\n".'Answer:'."\n- ".str($message)->limit(120);
        $citations = collect($top)->pluck('title')->unique()->values()->all();
        return ['answer' => $answer, 'citations' => $citations];
    }
}
