<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Ports\Output;

use hexagonal\Modules\Business\Entities\User;

interface FindUserOutputPort
{
    public function byId(string $id): ?User;
}
