<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster;

use _PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts Reflector related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
 */
class ReflectionCaster
{
    const UNSET_CLOSURE_FILE_INFO = ['Closure' => __CLASS__ . '::unsetClosureFileInfo'];
    private static $extraMap = ['docComment' => 'getDocComment', 'extension' => 'getExtensionName', 'isDisabled' => 'isDisabled', 'isDeprecated' => 'isDeprecated', 'isInternal' => 'isInternal', 'isUserDefined' => 'isUserDefined', 'isGenerator' => 'isGenerator', 'isVariadic' => 'isVariadic'];
    public static function castClosure(\Closure $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested, int $filter = 0)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        $c = new \ReflectionFunction($c);
        $a = static::castFunctionAbstract($c, $a, $stub, $isNested, $filter);
        if (\false === \strpos($c->name, '{closure}')) {
            $stub->class = isset($a[$prefix . 'class']) ? $a[$prefix . 'class']->value . '::' . $c->name : $c->name;
            unset($a[$prefix . 'class']);
        }
        unset($a[$prefix . 'extra']);
        $stub->class .= self::getSignature($a);
        if ($f = $c->getFileName()) {
            $stub->attr['file'] = $f;
            $stub->attr['line'] = $c->getStartLine();
        }
        unset($a[$prefix . 'parameters']);
        if ($filter & \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE) {
            $stub->cut += ($c->getFileName() ? 2 : 0) + \count($a);
            return [];
        }
        if ($f) {
            $a[$prefix . 'file'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\LinkStub($f, $c->getStartLine());
            $a[$prefix . 'line'] = $c->getStartLine() . ' to ' . $c->getEndLine();
        }
        return $a;
    }
    public static function unsetClosureFileInfo(\Closure $c, array $a)
    {
        unset($a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'file'], $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'line']);
        return $a;
    }
    public static function castGenerator(\Generator $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        // Cannot create ReflectionGenerator based on a terminated Generator
        try {
            $reflectionGenerator = new \ReflectionGenerator($c);
        } catch (\Exception $e) {
            $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'closed'] = \true;
            return $a;
        }
        return self::castReflectionGenerator($reflectionGenerator, $a, $stub, $isNested);
    }
    public static function castType(\ReflectionType $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'name' => $c instanceof \ReflectionNamedType ? $c->getName() : (string) $c, $prefix . 'allowsNull' => $c->allowsNull(), $prefix . 'isBuiltin' => $c->isBuiltin()];
        return $a;
    }
    public static function castReflectionGenerator(\ReflectionGenerator $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        if ($c->getThis()) {
            $a[$prefix . 'this'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\CutStub($c->getThis());
        }
        $function = $c->getFunction();
        $frame = ['class' => isset($function->class) ? $function->class : null, 'type' => isset($function->class) ? $function->isStatic() ? '::' : '->' : null, 'function' => $function->name, 'file' => $c->getExecutingFile(), 'line' => $c->getExecutingLine()];
        if ($trace = $c->getTrace(\DEBUG_BACKTRACE_IGNORE_ARGS)) {
            $function = new \ReflectionGenerator($c->getExecutingGenerator());
            \array_unshift($trace, ['function' => 'yield', 'file' => $function->getExecutingFile(), 'line' => $function->getExecutingLine() - 1]);
            $trace[] = $frame;
            $a[$prefix . 'trace'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\TraceStub($trace, \false, 0, -1, -1);
        } else {
            $function = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\FrameStub($frame, \false, \true);
            $function = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\ExceptionCaster::castFrameStub($function, [], $function, \true);
            $a[$prefix . 'executing'] = $function[$prefix . 'src'];
        }
        $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'closed'] = \false;
        return $a;
    }
    public static function castClass(\ReflectionClass $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested, int $filter = 0)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        if ($n = \Reflection::getModifierNames($c->getModifiers())) {
            $a[$prefix . 'modifiers'] = \implode(' ', $n);
        }
        self::addMap($a, $c, ['extends' => 'getParentClass', 'implements' => 'getInterfaceNames', 'constants' => 'getConstants']);
        foreach ($c->getProperties() as $n) {
            $a[$prefix . 'properties'][$n->name] = $n;
        }
        foreach ($c->getMethods() as $n) {
            $a[$prefix . 'methods'][$n->name] = $n;
        }
        if (!($filter & \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE) && !$isNested) {
            self::addExtra($a, $c);
        }
        return $a;
    }
    public static function castFunctionAbstract(\ReflectionFunctionAbstract $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested, int $filter = 0)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        self::addMap($a, $c, ['returnsReference' => 'returnsReference', 'returnType' => 'getReturnType', 'class' => 'getClosureScopeClass', 'this' => 'getClosureThis']);
        if (isset($a[$prefix . 'returnType'])) {
            $v = $a[$prefix . 'returnType'];
            $v = $v instanceof \ReflectionNamedType ? $v->getName() : (string) $v;
            $a[$prefix . 'returnType'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\ClassStub($a[$prefix . 'returnType']->allowsNull() ? '?' . $v : $v, [\class_exists($v, \false) || \interface_exists($v, \false) || \trait_exists($v, \false) ? $v : '', '']);
        }
        if (isset($a[$prefix . 'class'])) {
            $a[$prefix . 'class'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\ClassStub($a[$prefix . 'class']);
        }
        if (isset($a[$prefix . 'this'])) {
            $a[$prefix . 'this'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\CutStub($a[$prefix . 'this']);
        }
        foreach ($c->getParameters() as $v) {
            $k = '$' . $v->name;
            if ($v->isVariadic()) {
                $k = '...' . $k;
            }
            if ($v->isPassedByReference()) {
                $k = '&' . $k;
            }
            $a[$prefix . 'parameters'][$k] = $v;
        }
        if (isset($a[$prefix . 'parameters'])) {
            $a[$prefix . 'parameters'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\EnumStub($a[$prefix . 'parameters']);
        }
        if (!($filter & \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE) && ($v = $c->getStaticVariables())) {
            foreach ($v as $k => &$v) {
                if (\is_object($v)) {
                    $a[$prefix . 'use']['$' . $k] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\CutStub($v);
                } else {
                    $a[$prefix . 'use']['$' . $k] =& $v;
                }
            }
            unset($v);
            $a[$prefix . 'use'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\EnumStub($a[$prefix . 'use']);
        }
        if (!($filter & \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::EXCLUDE_VERBOSE) && !$isNested) {
            self::addExtra($a, $c);
        }
        return $a;
    }
    public static function castMethod(\ReflectionMethod $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'modifiers'] = \implode(' ', \Reflection::getModifierNames($c->getModifiers()));
        return $a;
    }
    public static function castParameter(\ReflectionParameter $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        self::addMap($a, $c, ['position' => 'getPosition', 'isVariadic' => 'isVariadic', 'byReference' => 'isPassedByReference', 'allowsNull' => 'allowsNull']);
        if ($v = $c->getType()) {
            $a[$prefix . 'typeHint'] = $v instanceof \ReflectionNamedType ? $v->getName() : (string) $v;
        }
        if (isset($a[$prefix . 'typeHint'])) {
            $v = $a[$prefix . 'typeHint'];
            $a[$prefix . 'typeHint'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\ClassStub($v, [\class_exists($v, \false) || \interface_exists($v, \false) || \trait_exists($v, \false) ? $v : '', '']);
        } else {
            unset($a[$prefix . 'allowsNull']);
        }
        try {
            $a[$prefix . 'default'] = $v = $c->getDefaultValue();
            if ($c->isDefaultValueConstant()) {
                $a[$prefix . 'default'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\ConstStub($c->getDefaultValueConstantName(), $v);
            }
            if (null === $v) {
                unset($a[$prefix . 'allowsNull']);
            }
        } catch (\ReflectionException $e) {
        }
        return $a;
    }
    public static function castProperty(\ReflectionProperty $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'modifiers'] = \implode(' ', \Reflection::getModifierNames($c->getModifiers()));
        self::addExtra($a, $c);
        return $a;
    }
    public static function castReference(\ReflectionReference $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'id'] = $c->getId();
        return $a;
    }
    public static function castExtension(\ReflectionExtension $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        self::addMap($a, $c, ['version' => 'getVersion', 'dependencies' => 'getDependencies', 'iniEntries' => 'getIniEntries', 'isPersistent' => 'isPersistent', 'isTemporary' => 'isTemporary', 'constants' => 'getConstants', 'functions' => 'getFunctions', 'classes' => 'getClasses']);
        return $a;
    }
    public static function castZendExtension(\ReflectionZendExtension $c, array $a, \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested)
    {
        self::addMap($a, $c, ['version' => 'getVersion', 'author' => 'getAuthor', 'copyright' => 'getCopyright', 'url' => 'getURL']);
        return $a;
    }
    public static function getSignature(array $a)
    {
        $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL;
        $signature = '';
        if (isset($a[$prefix . 'parameters'])) {
            foreach ($a[$prefix . 'parameters']->value as $k => $param) {
                $signature .= ', ';
                if ($type = $param->getType()) {
                    if (!$type instanceof \ReflectionNamedType) {
                        $signature .= $type . ' ';
                    } else {
                        if (!$param->isOptional() && $param->allowsNull()) {
                            $signature .= '?';
                        }
                        $signature .= \substr(\strrchr('\\' . $type->getName(), '\\'), 1) . ' ';
                    }
                }
                $signature .= $k;
                if (!$param->isDefaultValueAvailable()) {
                    continue;
                }
                $v = $param->getDefaultValue();
                $signature .= ' = ';
                if ($param->isDefaultValueConstant()) {
                    $signature .= \substr(\strrchr('\\' . $param->getDefaultValueConstantName(), '\\'), 1);
                } elseif (null === $v) {
                    $signature .= 'null';
                } elseif (\is_array($v)) {
                    $signature .= $v ? '[…' . \count($v) . ']' : '[]';
                } elseif (\is_string($v)) {
                    $signature .= 10 > \strlen($v) && \false === \strpos($v, '\\') ? "'{$v}'" : "'…" . \strlen($v) . "'";
                } elseif (\is_bool($v)) {
                    $signature .= $v ? 'true' : 'false';
                } else {
                    $signature .= $v;
                }
            }
        }
        $signature = (empty($a[$prefix . 'returnsReference']) ? '' : '&') . '(' . \substr($signature, 2) . ')';
        if (isset($a[$prefix . 'returnType'])) {
            $signature .= ': ' . \substr(\strrchr('\\' . $a[$prefix . 'returnType'], '\\'), 1);
        }
        return $signature;
    }
    private static function addExtra(array &$a, \Reflector $c)
    {
        $x = isset($a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'extra']) ? $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'extra']->value : [];
        if (\method_exists($c, 'getFileName') && ($m = $c->getFileName())) {
            $x['file'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\LinkStub($m, $c->getStartLine());
            $x['line'] = $c->getStartLine() . ' to ' . $c->getEndLine();
        }
        self::addMap($x, $c, self::$extraMap, '');
        if ($x) {
            $a[\_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'extra'] = new \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\EnumStub($x);
        }
    }
    private static function addMap(array &$a, \Reflector $c, array $map, string $prefix = \_PhpScoperf701e46e48a5\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL)
    {
        foreach ($map as $k => $m) {
            if (\PHP_VERSION_ID >= 80000 && 'isDisabled' === $k) {
                continue;
            }
            if (\method_exists($c, $m) && \false !== ($m = $c->{$m}()) && null !== $m) {
                $a[$prefix . $k] = $m instanceof \Reflector ? $m->name : $m;
            }
        }
    }
}
