<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Output;

use hexagonal\Modules\Business\Entities\User;

interface UpdateUserOutputPort
{
    public function update(string $id, User $user): User;
}
