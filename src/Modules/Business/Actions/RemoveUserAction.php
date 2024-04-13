<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Actions;

use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Input\RemoveUserActionInputPort;
use hexagonal\Modules\Business\Ports\Output\DeleteUserOuptputPort;

final class RemoveUserAction implements RemoveUserActionInputPort
{
    public function __construct(
        private ReadUserByIdAction $readUserByIdAction,
        private DeleteUserOuptputPort $deleteUserOuptputPort,
    ) {
    }

    public function execute(string $userId): User
    {
        $this->readUserByIdAction->execute($userId);
        return $this->deleteUserOuptputPort->delete($userId);
    }
}
