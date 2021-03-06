<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\Mime;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @experimental in 4.3
 */
final class NamedAddress extends \_PhpScoper36281e29f54f\Symfony\Component\Mime\Address
{
    private $name;
    public function __construct(string $address, string $name)
    {
        parent::__construct($address);
        $this->name = $name;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getEncodedNamedAddress() : string
    {
        return ($n = $this->getName()) ? $n . ' <' . $this->getEncodedAddress() . '>' : $this->getEncodedAddress();
    }
    public function toString() : string
    {
        return $this->getEncodedNamedAddress();
    }
}
