<?php

use DI\ContainerBuilder;

return function(ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => function() {
            return [
                'name' => 'example slim application',
                'displayErrorDetails' => true,
                'logErrors' => true,
                'logErrorDetails' => true,
            ];
        }
    ]);
};
