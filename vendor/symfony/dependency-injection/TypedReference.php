<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScopereb9e28d9f307\Symfony\Component\DependencyInjection;

/**
 * Represents a PHP type-hinted service reference.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class TypedReference extends \_PhpScopereb9e28d9f307\Symfony\Component\DependencyInjection\Reference
{
    private $type;
    private $name;
    /**
     * @param string $id              The service identifier
     * @param string $type            The PHP type of the identified service
     * @param int    $invalidBehavior The behavior when the service does not exist
     * @param string $name            The name of the argument targeting the service
     */
    public function __construct(string $id, string $type, int $invalidBehavior = \_PhpScopereb9e28d9f307\Symfony\Component\DependencyInjection\ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, string $name = null)
    {
        $this->name = $type === $id ? $name : null;
        parent::__construct($id, $invalidBehavior);
        $this->type = $type;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getName() : ?string
    {
        return $this->name;
    }
}
