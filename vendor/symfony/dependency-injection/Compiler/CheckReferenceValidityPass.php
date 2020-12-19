<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Compiler;

use _PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Definition;
use _PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Exception\RuntimeException;
use _PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Reference;
/**
 * Checks the validity of references.
 *
 * The following checks are performed by this pass:
 * - target definitions are not abstract
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class CheckReferenceValidityPass extends \_PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass
{
    protected function processValue($value, bool $isRoot = \false)
    {
        if ($isRoot && $value instanceof \_PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Definition && ($value->isSynthetic() || $value->isAbstract())) {
            return $value;
        }
        if ($value instanceof \_PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Reference && $this->container->hasDefinition((string) $value)) {
            $targetDefinition = $this->container->getDefinition((string) $value);
            if ($targetDefinition->isAbstract()) {
                throw new \_PhpScoper3b1dc0f3c466\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('The definition "%s" has a reference to an abstract definition "%s". Abstract definitions cannot be the target of references.', $this->currentId, $value));
            }
        }
        return parent::processValue($value, $isRoot);
    }
}
