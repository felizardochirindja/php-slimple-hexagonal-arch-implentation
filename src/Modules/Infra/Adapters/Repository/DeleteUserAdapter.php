<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Adapters\Repository;

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Output\DeleteUserOuptputPort;

final class DeleteUserAdapter implements DeleteUserOuptputPort
{
    public function __construct(
        private InMemoryStorage $storage,
    ) {
    }

    public function delete(string $id): User
    {
        /**
         * @var User $removedUser
         */
        $removedUser = null;
        
        array_walk($this->storage->users, function (User $userFromStorage, int $index) use ($id, &$removedUser) {
            if ($userFromStorage->id === $id) {
                $removedUser = $this->storage->users[$index];
                unset($this->storage->users[$index]);
            }
        });

        return $removedUser;
    }
}
