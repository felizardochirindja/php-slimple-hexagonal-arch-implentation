<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Entities;

final readonly class Movie
{
    private function __construct(
        public string $id,
        public string $name,
        public string $description,
    ) {
    }

    public static function createWithoutId(string $name, string $description): self
    {
        return new self(uniqid(), $name, $description);
    }

    public static function createWithId(string $id, string $name, string $description): self
    {
        return new self($id, $name, $description);
    }
}
