<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Actions;

use Exception;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\Input\ReadUserByIdActionInputPort;
use hexagonal\Modules\Business\Ports\Output\FindUserOutputPort;

final class ReadUserByIdAction implements ReadUserByIdActionInputPort
{
    public function __construct(
        private FindUserOutputPort $findUserPort,
    ) {
    }

    public function execute(string $userId): User
    {
        $user = $this->findUserPort->byId($userId);

        if ($user === null) {
            throw new Exception("user not found!");
        }

        return $user;
    }
}
