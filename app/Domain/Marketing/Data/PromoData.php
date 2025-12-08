<?php

namespace App\Domain\Marketing\Data;

final class PromoData
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title,
        public readonly string $text,
        public readonly ?string $cta,
        public readonly ?string $link,
        public readonly ?string $imagePath,
        public readonly ?string $locale,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            id: isset($payload['id']) ? (int) $payload['id'] : null,
            title: (string) $payload['title'],
            text: (string) $payload['text'],
            cta: $payload['cta'] ?? null,
            link: $payload['link'] ?? null,
            imagePath: $payload['image_path'] ?? null,
            locale: $payload['locale'] ?? null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $attributes = [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'cta' => $this->cta,
            'link' => $this->link,
            'image_path' => $this->imagePath,
            'locale' => $this->locale,
        ];

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
