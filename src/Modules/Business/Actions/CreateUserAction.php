<?php

declare(strict_types=1);

namespace hexagonal\Modules\Business\Actions;

use Exception;
use hexagonal\Modules\Business\Entities\User;
use hexagonal\Modules\Business\Ports\DTO\CreateUserInput;
use hexagonal\Modules\Business\Ports\Input\CreateUserActionInputPort;
use hexagonal\Modules\Business\Ports\Output\FindMovieOutputPort;
use hexagonal\Modules\Business\Ports\Output\SaveUserOutputPort;

final class CreateUserAction implements CreateUserActionInputPort
{
    public function __construct(
        private SaveUserOutputPort $saveUserPort,
        private FindMovieOutputPort $findMoviePort,
    ) {
    }

    public function execute(CreateUserInput $input): User
    {
        $favoriteMovie = $this->findMoviePort->byId($input->favoriteMovieId);

        if ($favoriteMovie === null) {
            throw new Exception("movie not found!");
        }

        $user = User::createWithoutId($input->name, $favoriteMovie);

        return $this->saveUserPort->save($user);
    }
}
