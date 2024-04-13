<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Input;

use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\DTO\UpdateUserInput;

interface UpdateUserActionInputPort
{
    public function execute(UpdateUserInput $input): User;
}
