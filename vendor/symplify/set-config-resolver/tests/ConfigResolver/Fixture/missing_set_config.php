<?php

declare (strict_types=1);
namespace _PhpScoper3d7663d13234;

use _PhpScoper3d7663d13234\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use _PhpScoper3d7663d13234\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper3d7663d13234\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('sets', ['not_here']);
    $services = $containerConfigurator->services();
    $services->set(\_PhpScoper3d7663d13234\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
};
