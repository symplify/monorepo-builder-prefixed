<?php

declare (strict_types=1);
namespace _PhpScoper120e1a259c7c;

use _PhpScoper120e1a259c7c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper120e1a259c7c\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('sets', ['some_php_set']);
};
