<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Output\SaveUserOutputPort;

final class SaveUserAdapter implements SaveUserOutputPort
{
    public function __construct(
        private InMemoryStorage $storage,
    ) {
    }

    public function save(User $user): User
    {
        $this->storage->users[] = $user;
        return $user;
    }
}
