<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Output;

use hexagonal\Modules\Business\Entities\User;

interface SaveUserOutputPort
{
    public function save(User $user): User;
}
