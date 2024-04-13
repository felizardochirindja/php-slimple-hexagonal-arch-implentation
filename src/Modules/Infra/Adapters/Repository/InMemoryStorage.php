<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Business\Entities\Movie;
use hexagonal\Modules\Business\Entities\User;

final class InMemoryStorage
{
    /**
     * @param Movie[] $movies
     */
    public array $movies = [];
    /**
     * @param User[] $users
     */
    public array $users = [];

    public function __construct()
    {
        $this->movies = [
            Movie::createWithId('1', 'movie 1', 'description 1'),
            Movie::createWithId('2', 'movie 2', 'description 2'),
            Movie::createWithId('3', 'movie 3', 'description 3'),
            Movie::createWithId('4', 'movie 4', 'description 4'),
            Movie::createWithId('5', 'movie 5', 'description 5'),
        ];

        $this->users = [
            User::createWithId('65b0fee4e7ec5', 'felix', Movie::createWithId('1', 'movie 1', 'description 1')),
            User::createWithId('65b0fff7edcf8', 'jorge', Movie::createWithId('2', 'movie 3', 'description 2')),
        ];
    }
}
