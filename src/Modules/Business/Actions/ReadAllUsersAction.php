<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Actions;

use Exception;
use hexagonal\Modules\Business\Ports\Input\ReadAllUsersActionInputPort;
use hexagonal\Modules\Business\Ports\Output\FindAllUsersOutputPort;
use hexagonal\Modules\Business\Ports\Output\FindUserOutputPort;

final class ReadAllUsersAction implements ReadAllUsersActionInputPort
{
    public function __construct(
        private FindAllUsersOutputPort $findAllUsersOutputPort,
    ) {
    }

    public function execute(): array
    {
        return $this->findAllUsersOutputPort->findAll();
    }
}
