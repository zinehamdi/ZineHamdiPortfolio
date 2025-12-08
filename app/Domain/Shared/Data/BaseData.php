<?php

namespace App\Domain\Shared\Data;

abstract class BaseData
{
    public function __construct(array $attributes = [])
    {
        $assign = \Closure::bind(function (string $property, $value): void {
            $this->{$property} = $value;
        }, $this, static::class);

        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $assign($key, $value);
            }
        }
    }

    public static function fromArray(array $attributes): static
    {
        return new static($attributes);
    }

    public function toArray(): array
    {
        $payload = [];

        foreach (get_object_vars($this) as $key => $value) {
            $payload[$key] = $value;
        }

        return $payload;
    }
}
