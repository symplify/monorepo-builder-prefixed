<?php

declare (strict_types=1);
namespace _PhpScopera28be7b3fe51;

use _PhpScopera28be7b3fe51\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScopera28be7b3fe51\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('key', 'value');
};
