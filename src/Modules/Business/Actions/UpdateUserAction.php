<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Actions;

use Exception;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\DTO\UpdateUserInput;
use hexagonal\Modules\Business\Ports\Input\UpdateUserActionInputPort;
use hexagonal\Modules\Business\Ports\Output\FindMovieOutputPort;
use hexagonal\Modules\Business\Ports\Output\UpdateUserOutputPort;

final class UpdateUserAction implements UpdateUserActionInputPort
{
    public function __construct(
        private ReadUserByIdAction $readUserByIdAction,
        private FindMovieOutputPort $findMoviePort,
        private UpdateUserOutputPort $updateUserOutputPort,
    ) {
    }

    public function execute(UpdateUserInput $input): User
    {
        $this->readUserByIdAction->execute($input->id);

        $favoriteMovie = $this->findMoviePort->byId($input->favoriteMovieId);

        if ($favoriteMovie === null) {
            throw new Exception("movie not found!");
        }

        $user = User::createWithId($input->id, $input->name, $favoriteMovie);

        return $this->updateUserOutputPort->update($input->id, $user);
    }
}
