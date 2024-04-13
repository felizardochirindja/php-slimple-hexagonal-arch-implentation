<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Input;

use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\DTO\CreateUserInput;

interface CreateUserActionInputPort
{
    public function execute(CreateUserInput $input): User;
}
