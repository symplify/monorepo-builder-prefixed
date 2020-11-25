<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInit239295c31e5ee08ce2ae3fa285019182', false) && !interface_exists('ComposerAutoloaderInit239295c31e5ee08ce2ae3fa285019182', false) && !trait_exists('ComposerAutoloaderInit239295c31e5ee08ce2ae3fa285019182', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\ComposerAutoloaderInit239295c31e5ee08ce2ae3fa285019182');
}
if (!class_exists('Throwable', false) && !interface_exists('Throwable', false) && !trait_exists('Throwable', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\Throwable');
}
if (!class_exists('Error', false) && !interface_exists('Error', false) && !trait_exists('Error', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\Error');
}
if (!class_exists('TypeError', false) && !interface_exists('TypeError', false) && !trait_exists('TypeError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\TypeError');
}
if (!class_exists('DieHardTest', false) && !interface_exists('DieHardTest', false) && !trait_exists('DieHardTest', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\DieHardTest');
}
if (!class_exists('StatTest', false) && !interface_exists('StatTest', false) && !trait_exists('StatTest', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\StatTest');
}
if (!class_exists('RandomBytesTest', false) && !interface_exists('RandomBytesTest', false) && !trait_exists('RandomBytesTest', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\RandomBytesTest');
}
if (!class_exists('RandomIntTest', false) && !interface_exists('RandomIntTest', false) && !trait_exists('RandomIntTest', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\RandomIntTest');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\Normalizer');
}
if (!class_exists('ArithmeticError', false) && !interface_exists('ArithmeticError', false) && !trait_exists('ArithmeticError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\ArithmeticError');
}
if (!class_exists('AssertionError', false) && !interface_exists('AssertionError', false) && !trait_exists('AssertionError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\AssertionError');
}
if (!class_exists('DivisionByZeroError', false) && !interface_exists('DivisionByZeroError', false) && !trait_exists('DivisionByZeroError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\DivisionByZeroError');
}
if (!class_exists('ParseError', false) && !interface_exists('ParseError', false) && !trait_exists('ParseError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\ParseError');
}
if (!class_exists('SessionUpdateTimestampHandlerInterface', false) && !interface_exists('SessionUpdateTimestampHandlerInterface', false) && !trait_exists('SessionUpdateTimestampHandlerInterface', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\SessionUpdateTimestampHandlerInterface');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\Stringable');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('_PhpScoper44b9ade4c89e\ValueError');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('composerRequire239295c31e5ee08ce2ae3fa285019182')) {
    function composerRequire239295c31e5ee08ce2ae3fa285019182() {
        return \_PhpScoper44b9ade4c89e\composerRequire239295c31e5ee08ce2ae3fa285019182(...func_get_args());
    }
}
if (!function_exists('RandomCompat_strlen')) {
    function RandomCompat_strlen() {
        return \_PhpScoper44b9ade4c89e\RandomCompat_strlen(...func_get_args());
    }
}
if (!function_exists('RandomCompat_substr')) {
    function RandomCompat_substr() {
        return \_PhpScoper44b9ade4c89e\RandomCompat_substr(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \_PhpScoper44b9ade4c89e\setproctitle(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \_PhpScoper44b9ade4c89e\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \_PhpScoper44b9ade4c89e\dump(...func_get_args());
    }
}
if (!function_exists('dd')) {
    function dd() {
        return \_PhpScoper44b9ade4c89e\dd(...func_get_args());
    }
}

return $loader;
