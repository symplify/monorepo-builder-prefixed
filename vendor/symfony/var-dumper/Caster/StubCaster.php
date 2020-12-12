<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Caster;

use _PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts a caster's Stub.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final since Symfony 4.4
 */
class StubCaster
{
    public static function castStub(\_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub $c, array $a, \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        if ($isNested) {
            $stub->type = $c->type;
            $stub->class = $c->class;
            $stub->value = $c->value;
            $stub->handle = $c->handle;
            $stub->cut = $c->cut;
            $stub->attr = $c->attr;
            if (\_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub::TYPE_REF === $c->type && !$c->class && \is_string($c->value) && !\preg_match('//u', $c->value)) {
                $stub->type = \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub::TYPE_STRING;
                $stub->class = \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub::STRING_BINARY;
            }
            $a = [];
        }
        return $a;
    }
    public static function castCutArray(\_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Caster\CutArrayStub $c, array $a, \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        return $isNested ? $c->preservedSubset : $a;
    }
    public static function cutInternals($obj, array $a, \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        if ($isNested) {
            $stub->cut += \count($a);
            return [];
        }
        return $a;
    }
    public static function castEnum(\_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Caster\EnumStub $c, array $a, \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        if ($isNested) {
            $stub->class = $c->dumpKeys ? '' : null;
            $stub->handle = 0;
            $stub->value = null;
            $stub->cut = $c->cut;
            $stub->attr = $c->attr;
            $a = [];
            if ($c->value) {
                foreach (\array_keys($c->value) as $k) {
                    $keys[] = !isset($k[0]) || "\0" !== $k[0] ? \_PhpScoper7cc068f3f5d1\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . $k : $k;
                }
                // Preserve references with array_combine()
                $a = \array_combine($keys, $c->value);
            }
        }
        return $a;
    }
}
