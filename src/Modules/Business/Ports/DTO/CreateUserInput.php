<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\DTO;

final readonly class CreateUserInput
{
    public function __construct(
        public string $name,
        public string $favoriteMovieId,
    ) {
    }
}
