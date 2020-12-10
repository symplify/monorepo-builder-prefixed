<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperec2b815193b4\Symfony\Component\DependencyInjection\Argument;

/**
 * @author Guilhem Niot <guilhem.niot@gmail.com>
 */
final class BoundArgument implements \_PhpScoperec2b815193b4\Symfony\Component\DependencyInjection\Argument\ArgumentInterface
{
    const SERVICE_BINDING = 0;
    const DEFAULTS_BINDING = 1;
    const INSTANCEOF_BINDING = 2;
    private static $sequence = 0;
    private $value;
    private $identifier;
    private $used;
    private $type;
    private $file;
    public function __construct($value, bool $trackUsage = \true, int $type = 0, string $file = null)
    {
        $this->value = $value;
        if ($trackUsage) {
            $this->identifier = ++self::$sequence;
        } else {
            $this->used = \true;
        }
        $this->type = $type;
        $this->file = $file;
    }
    /**
     * {@inheritdoc}
     */
    public function getValues() : array
    {
        return [$this->value, $this->identifier, $this->used, $this->type, $this->file];
    }
    /**
     * {@inheritdoc}
     */
    public function setValues(array $values)
    {
        if (5 === \count($values)) {
            list($this->value, $this->identifier, $this->used, $this->type, $this->file) = $values;
        } else {
            list($this->value, $this->identifier, $this->used) = $values;
        }
    }
}
