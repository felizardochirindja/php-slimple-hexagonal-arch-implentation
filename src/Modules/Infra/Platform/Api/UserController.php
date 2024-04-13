<?php

declare(strict_types=1);

namespace hexagonal\Modules\Infra\Platform\Api;

use hexagonal\Modules\Business\Ports\DTO\CreateUserInput;
use hexagonal\Modules\Business\Ports\DTO\UpdateUserInput;
use hexagonal\Modules\Business\Ports\Input\CreateUserActionInputPort;
use hexagonal\Modules\Business\Ports\Input\ReadUserByIdActionInputPort;
use hexagonal\Modules\Business\Ports\Input\RemoveUserActionInputPort;
use hexagonal\Modules\Business\Ports\Input\UpdateUserActionInputPort;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserController
{
    public function __construct(
        private CreateUserActionInputPort $createUserActionInputPort,
        private UpdateUserActionInputPort $updateUserActionInputPort,
        private ReadUserByIdActionInputPort $readUserActionInputPort,
        private RemoveUserActionInputPort $removeUserActionInputPort,
    ) {
    }

    public function createUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = new CreateUserInput(
            $request->getParsedBody()['name'],
            (string) $request->getParsedBody()['favoriteMovieId'],
        );

        $user = $this->createUserActionInputPort->execute($input);

        $response
            ->getBody()
            ->write(json_encode([
                'status' => 'OK',
                'message' => 'user created successfully!',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,

                        'favoriteMovie' => [
                            'id' => $user->favoriteMovie->id,
                            'name' => $user->favoriteMovie->name,
                        ],
                    ],
                ],
            ],));

        $response = $response
            ->withStatus(201)
            ->withAddedHeader('Content-Type', 'application/json');

        return $response;
    }

    public function updateUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = new UpdateUserInput(
            $request->getParsedBody()['id'],
            $request->getParsedBody()['name'],
            (string) $request->getParsedBody()['favoriteMovieId'],
        );

        $user = $this->updateUserActionInputPort->execute($input);

        $response
            ->getBody()
            ->write(json_encode([
                'status' => 'OK',
                'message' => 'user updated successfully!',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,

                        'favoriteMovie' => [
                            'id' => $user->favoriteMovie->id,
                            'name' => $user->favoriteMovie->name,
                        ],
                    ],
                ],
            ],));

        $response = $response
            ->withStatus(201)
            ->withAddedHeader('Content-Type', 'application/json');

        return $response;
    }

    public function readUserById(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $user = $this->readUserActionInputPort->execute(
            (string) $request->getAttribute('userId'),
        );

        $response
            ->getBody()
            ->write(json_encode([
                'status' => 'OK',
                'message' => 'user read successfully!',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,

                        'favoriteMovie' => [
                            'id' => $user->favoriteMovie->id,
                            'name' => $user->favoriteMovie->name,
                        ],
                    ],
                ],
            ],));

        $response = $response
            ->withStatus(200)
            ->withAddedHeader('Content-Type', 'application/json');

        return $response;
    }

    public function removeUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $user = $this->removeUserActionInputPort->execute(
            (string) $request->getAttribute('userId'),
        );

        $response
            ->getBody()
            ->write(json_encode([
                'status' => 'OK',
                'message' => 'user removed successfully!',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,

                        'favoriteMovie' => [
                            'id' => $user->favoriteMovie->id,
                            'name' => $user->favoriteMovie->name,
                        ],
                    ],
                ],
            ],));

        $response = $response
            ->withStatus(200)
            ->withAddedHeader('Content-Type', 'application/json');

        return $response;
    }
}
