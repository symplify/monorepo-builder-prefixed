<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb445cd48032c\Symfony\Component\Mime\DependencyInjection;

use _PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\Reference;
/**
 * Registers custom mime types guessers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @experimental in 4.3
 */
class AddMimeTypeGuesserPass implements \_PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    private $mimeTypesService;
    private $mimeTypeGuesserTag;
    public function __construct(string $mimeTypesService = 'mime_types', string $mimeTypeGuesserTag = 'mime.mime_type_guesser')
    {
        $this->mimeTypesService = $mimeTypesService;
        $this->mimeTypeGuesserTag = $mimeTypeGuesserTag;
    }
    /**
     * {@inheritdoc}
     */
    public function process(\_PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        if ($container->has($this->mimeTypesService)) {
            $definition = $container->findDefinition($this->mimeTypesService);
            foreach ($container->findTaggedServiceIds($this->mimeTypeGuesserTag, \true) as $id => $attributes) {
                $definition->addMethodCall('registerGuesser', [new \_PhpScoperb445cd48032c\Symfony\Component\DependencyInjection\Reference($id)]);
            }
        }
    }
}
