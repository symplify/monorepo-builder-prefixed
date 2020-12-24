<?php

declare (strict_types=1);
namespace _PhpScoper68e56c1b5bd9;

use _PhpScoper68e56c1b5bd9\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper68e56c1b5bd9\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->load('Symplify\\AutowireArrayParameter\\Tests\\Source\\', __DIR__ . '/../Source');
};
