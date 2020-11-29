<?php

declare (strict_types=1);
namespace _PhpScoper8a93e17d4d47;

use _PhpScoper8a93e17d4d47\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use _PhpScoper8a93e17d4d47\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper8a93e17d4d47\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('sets', ['not_here']);
    $services = $containerConfigurator->services();
    $services->set(\_PhpScoper8a93e17d4d47\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
};
