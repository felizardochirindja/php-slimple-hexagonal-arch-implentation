<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Output\UpdateUserOutputPort;

final class UpdateUserAdapter implements UpdateUserOutputPort
{
    public function __construct(
        private InMemoryStorage $storage,
    ) {
    }

    public function update(string $id, User $user): User
    {
        $updatedUserId = -1; 
        
        array_walk($this->storage->users, function (User $userFromStorage, int $index) use ($id, $user, &$updatedUserId) {
            if ($userFromStorage->id === $id) {
                $this->storage->users[$index] = $user;
                $updatedUserId = $index;
            }
        });

        return $this->storage->users[$updatedUserId];
    }
}
