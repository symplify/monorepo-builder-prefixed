<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperfec5e512f2f8\Symfony\Component\VarDumper\Caster;

use _PhpScoperfec5e512f2f8\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Represents an enumeration of values.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class EnumStub extends \_PhpScoperfec5e512f2f8\Symfony\Component\VarDumper\Cloner\Stub
{
    public $dumpKeys = \true;
    public function __construct(array $values, bool $dumpKeys = \true)
    {
        $this->value = $values;
        $this->dumpKeys = $dumpKeys;
    }
}
