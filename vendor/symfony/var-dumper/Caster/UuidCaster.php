<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper184bc0c88d68\Symfony\Component\VarDumper\Caster;

use _PhpScoper184bc0c88d68\Ramsey\Uuid\UuidInterface;
use _PhpScoper184bc0c88d68\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
final class UuidCaster
{
    public static function castRamseyUuid(\_PhpScoper184bc0c88d68\Ramsey\Uuid\UuidInterface $c, array $a, \_PhpScoper184bc0c88d68\Symfony\Component\VarDumper\Cloner\Stub $stub, bool $isNested) : array
    {
        $a += [\_PhpScoper184bc0c88d68\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL . 'uuid' => (string) $c];
        return $a;
    }
}
