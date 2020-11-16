<?php

declare (strict_types=1);
namespace _PhpScoper1c1f12bbe5a7;

use _PhpScoper1c1f12bbe5a7\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use _PhpScoper1c1f12bbe5a7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper1c1f12bbe5a7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('sets', ['not_here']);
    $services = $containerConfigurator->services();
    $services->set(\_PhpScoper1c1f12bbe5a7\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
};
