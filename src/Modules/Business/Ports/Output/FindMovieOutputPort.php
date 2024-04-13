<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Output;

use hexagonal\Modules\Business\Entities\Movie;

interface FindMovieOutputPort
{
    public function byId(string $id): ?Movie;
}
