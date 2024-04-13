<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Entities;

final readonly class User
{
    private function __construct(
        public string $id,
        public string $name,
        public Movie $favoriteMovie,
    ) {
    }

    public static function createWithoutId(string $name, Movie $favoriteMovie): self
    {
        return new self(uniqid(), $name, $favoriteMovie);
    }

    public static function createWithId(string $id, string $name, Movie $favoriteMovie): self
    {
        return new self($id, $name, $favoriteMovie);
    }
}
