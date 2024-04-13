<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use hexagonal\Modules\Business\Entities\Movie;
use hexagonal\Modules\Business\Ports\Output\FindMovieOutputPort;

final class FindMovieAdapter implements FindMovieOutputPort
{
    public function __construct(
        private InMemoryStorage $storage,
    ) {
    }

    public function byId(string $id): ?Movie
    {
        $result = array_filter(
            $this->storage->movies,
            fn (Movie $movie) => $movie->id === $id
        );

        return empty($result) ? null : $result[array_key_first($result)];
    }
}
