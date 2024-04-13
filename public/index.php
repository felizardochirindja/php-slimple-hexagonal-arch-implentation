<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

/**
 * @var callable $settings
 */
$settings = require_once __DIR__ . '/../src/config/settings.php';
$settings($containerBuilder);

/**
 * @var callable $dependencies
 */
$dependencies = require_once __DIR__ . '/../src/config/dependencies.php';
$dependencies($containerBuilder);

$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

/**
 * @var callable $middleware
 */
$middleware = require_once __DIR__ . '/../src/config/middleware.php';
$middleware($app);

// import your route files here
$itemRoutes = require_once __DIR__ . '/../src/Modules/Infra/Platform/Api/userRoutes.php';
$itemRoutes($app);

$app->run();
