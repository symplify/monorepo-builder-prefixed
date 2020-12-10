<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInit65136b327e2060d6af5f09159f8c59c3', false) && !interface_exists('ComposerAutoloaderInit65136b327e2060d6af5f09159f8c59c3', false) && !trait_exists('ComposerAutoloaderInit65136b327e2060d6af5f09159f8c59c3', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\ComposerAutoloaderInit65136b327e2060d6af5f09159f8c59c3');
}
if (!class_exists('Throwable', false) && !interface_exists('Throwable', false) && !trait_exists('Throwable', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\Throwable');
}
if (!class_exists('Error', false) && !interface_exists('Error', false) && !trait_exists('Error', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\Error');
}
if (!class_exists('TypeError', false) && !interface_exists('TypeError', false) && !trait_exists('TypeError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\TypeError');
}
if (!class_exists('DieHardTest', false) && !interface_exists('DieHardTest', false) && !trait_exists('DieHardTest', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\DieHardTest');
}
if (!class_exists('StatTest', false) && !interface_exists('StatTest', false) && !trait_exists('StatTest', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\StatTest');
}
if (!class_exists('RandomBytesTest', false) && !interface_exists('RandomBytesTest', false) && !trait_exists('RandomBytesTest', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\RandomBytesTest');
}
if (!class_exists('RandomIntTest', false) && !interface_exists('RandomIntTest', false) && !trait_exists('RandomIntTest', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\RandomIntTest');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\Normalizer');
}
if (!class_exists('ArithmeticError', false) && !interface_exists('ArithmeticError', false) && !trait_exists('ArithmeticError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\ArithmeticError');
}
if (!class_exists('AssertionError', false) && !interface_exists('AssertionError', false) && !trait_exists('AssertionError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\AssertionError');
}
if (!class_exists('DivisionByZeroError', false) && !interface_exists('DivisionByZeroError', false) && !trait_exists('DivisionByZeroError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\DivisionByZeroError');
}
if (!class_exists('ParseError', false) && !interface_exists('ParseError', false) && !trait_exists('ParseError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\ParseError');
}
if (!class_exists('SessionUpdateTimestampHandlerInterface', false) && !interface_exists('SessionUpdateTimestampHandlerInterface', false) && !trait_exists('SessionUpdateTimestampHandlerInterface', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\SessionUpdateTimestampHandlerInterface');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\Stringable');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('_PhpScoper8d3e33bd2be8\ValueError');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('composerRequire65136b327e2060d6af5f09159f8c59c3')) {
    function composerRequire65136b327e2060d6af5f09159f8c59c3() {
        return \_PhpScoper8d3e33bd2be8\composerRequire65136b327e2060d6af5f09159f8c59c3(...func_get_args());
    }
}
if (!function_exists('RandomCompat_strlen')) {
    function RandomCompat_strlen() {
        return \_PhpScoper8d3e33bd2be8\RandomCompat_strlen(...func_get_args());
    }
}
if (!function_exists('RandomCompat_substr')) {
    function RandomCompat_substr() {
        return \_PhpScoper8d3e33bd2be8\RandomCompat_substr(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \_PhpScoper8d3e33bd2be8\setproctitle(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \_PhpScoper8d3e33bd2be8\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \_PhpScoper8d3e33bd2be8\dump(...func_get_args());
    }
}
if (!function_exists('dd')) {
    function dd() {
        return \_PhpScoper8d3e33bd2be8\dd(...func_get_args());
    }
}

return $loader;
