<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb0229f14f861\Symfony\Component\VarDumper\Caster;

use _PhpScoperb0229f14f861\ProxyManager\Proxy\ProxyInterface;
use _PhpScoperb0229f14f861\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final since Symfony 4.4
 */
class ProxyManagerCaster
{
    public static function castProxy(\_PhpScoperb0229f14f861\ProxyManager\Proxy\ProxyInterface $c, array $a, \_PhpScoperb0229f14f861\Symfony\Component\VarDumper\Cloner\Stub $stub, $isNested)
    {
        if ($parent = \get_parent_class($c)) {
            $stub->class .= ' - ' . $parent;
        }
        $stub->class .= '@proxy';
        return $a;
    }
}
