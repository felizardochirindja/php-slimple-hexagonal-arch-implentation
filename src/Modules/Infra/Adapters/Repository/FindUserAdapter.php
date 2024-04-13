<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Output\FindUserOutputPort;

final class FindUserAdapter implements FindUserOutputPort
{
    public function __construct(
        private InMemoryStorage $storage,
    ) {
    }

    public function byId(string $id): ?User
    {
        $result = array_filter(
            $this->storage->users,
            fn (User $user) => $user->id === $id
        );

        return empty($result) ? null : $result[array_key_first($result)];
    }
}
