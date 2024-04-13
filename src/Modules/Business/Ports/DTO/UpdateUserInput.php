<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\DTO;

final readonly class UpdateUserInput
{
    public function __construct(
        public string $id,
        public string $name,
        public string $favoriteMovieId,
    ) {
    }
}
