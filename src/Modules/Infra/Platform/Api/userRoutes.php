<?php

declare(strict_types=1);

use hexagonal\Modules\Infra\Platform\Api\UserController;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;

return function (App $app) {
    $app->group('/users', function (RouteCollectorProxyInterface $group) {
        $group->post('/create', [UserController::class, 'createUser']);
        $group->put('/update', [UserController::class, 'updateUser']);
        $group->delete('/remove/{userId}', [UserController::class, 'removeUser']);
        $group->get('/{userId}', [UserController::class, 'readUserById']);
    });
};
