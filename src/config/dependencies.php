<?php

declare(strict_types=1);

use hexagonal\Modules\Infra\Adapters\Repository\InMemoryStorage;
use DI\ContainerBuilder;
use hexagonal\Modules\Infra\Platform\Api\UserController;
use hexagonal\Modules\Business\Actions\CreateUserAction;
use hexagonal\Modules\Business\Actions\ReadUserByIdAction;
use hexagonal\Modules\Business\Actions\RemoveUserAction;
use hexagonal\Modules\Business\Actions\UpdateUserAction;
use hexagonal\Modules\Business\Ports\Input\CreateUserActionInputPort;
use hexagonal\Modules\Business\Ports\Input\ReadUserByIdActionInputPort;
use hexagonal\Modules\Business\Ports\Input\RemoveUserActionInputPort;
use hexagonal\Modules\Business\Ports\Input\UpdateUserActionInputPort;
use hexagonal\Modules\Business\Ports\Output\DeleteUserOuptputPort;
use hexagonal\Modules\Business\Ports\Output\FindMovieOutputPort;
use hexagonal\Modules\Business\Ports\Output\FindUserOutputPort;
use hexagonal\Modules\Business\Ports\Output\SaveUserOutputPort;
use hexagonal\Modules\Business\Ports\Output\UpdateUserOutputPort;
use hexagonal\Modules\Infra\Adapters\Repository\DeleteUserAdapter;
use hexagonal\Modules\Infra\Adapters\Repository\FindMovieAdapter;
use hexagonal\Modules\Infra\Adapters\Repository\FindUserAdapter;
use hexagonal\Modules\Infra\Adapters\Repository\SaveUserAdapter;
use hexagonal\Modules\Infra\Adapters\Repository\UpdateUserAdapter;
use Psr\Container\ContainerInterface;

use function DI\create;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([        
        // repositories
        InMemoryStorage::class => create(InMemoryStorage::class),

        FindMovieOutputPort::class => function (ContainerInterface $container): FindMovieOutputPort {
            return new FindMovieAdapter($container->get(InMemoryStorage::class));
        },
        FindUserOutputPort::class => function (ContainerInterface $container): FindUserOutputPort {
            return new FindUserAdapter($container->get(InMemoryStorage::class));
        },
        DeleteUserOuptputPort::class => function (ContainerInterface $container): DeleteUserOuptputPort {
            return new DeleteUserAdapter($container->get(InMemoryStorage::class));
        },
        SaveUserOutputPort::class => function (ContainerInterface $container): SaveUserOutputPort {
            return new SaveUserAdapter($container->get(InMemoryStorage::class));
        },
        UpdateUserOutputPort::class => function (ContainerInterface $container): UpdateUserOutputPort {
            return new UpdateUserAdapter($container->get(InMemoryStorage::class));
        },

        // actions
        CreateUserActionInputPort::class => function (ContainerInterface $container): CreateUserActionInputPort {
            return new CreateUserAction(
                $container->get(SaveUserOutputPort::class),
                $container->get(FindMovieOutputPort::class),
            );
        },

        UpdateUserActionInputPort::class => function (ContainerInterface $container): UpdateUserActionInputPort {
            return new UpdateUserAction(
                $container->get(ReadUserByIdActionInputPort::class),
                $container->get(FindMovieOutputPort::class),
                $container->get(UpdateUserOutputPort::class),
            );
        },

        ReadUserByIdActionInputPort::class => function (ContainerInterface $container): ReadUserByIdActionInputPort {
            return new ReadUserByIdAction(
                $container->get(FindUserOutputPort::class),
            );
        },

        RemoveUserActionInputPort::class => function (ContainerInterface $container): RemoveUserActionInputPort {
            return new RemoveUserAction(
                $container->get(ReadUserByIdActionInputPort::class),
                $container->get(DeleteUserOuptputPort::class),
            );
        },

        // controllers
        UserController::class => function(ContainerInterface $container): UserController {
            return new UserController(
                $container->get(CreateUserActionInputPort::class),
                $container->get(UpdateUserActionInputPort::class),
                $container->get(ReadUserByIdActionInputPort::class),
                $container->get(RemoveUserActionInputPort::class),
            );
        },
    ]);
};
