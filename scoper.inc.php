<?php

declare (strict_types=1);
namespace _PhpScoperf0acd9a8c4f5;

use _PhpScoperf0acd9a8c4f5\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return ['prefix' => null, 'finders' => [], 'files-whitelist' => [
    // do not prefix "trigger_deprecatoin" from symfony - https://github.com/symfony/symfony/commit/0032b2a2893d3be592d4312b7b098fb9d71aca03
    // these paths are relative to this file location, so it should be in the root directory
    'vendor/symfony/deprecation-contracts/function.php',
    // avoid pre-slashing everything
    'composer.json',
], 'whitelist' => [
    // needed for autoload, that is not prefixed, since it's in bin/* file
    'Symplify\\*',
    // for config.php
    \_PhpScoperf0acd9a8c4f5\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator::class,
    'Composer\\*',
]];
