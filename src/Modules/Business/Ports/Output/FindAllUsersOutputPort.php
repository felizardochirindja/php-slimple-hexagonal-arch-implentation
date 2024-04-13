<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Output;

use hexagonal\Modules\Business\Entities\User;

interface FindAllUsersOutputPort
{
    /**
     * @return User[]
     */
    public function findAll(): array;
}
