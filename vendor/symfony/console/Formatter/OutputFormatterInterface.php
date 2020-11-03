<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper61d2aa534566\Symfony\Component\Console\Formatter;

/**
 * Formatter interface for console output.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface OutputFormatterInterface
{
    /**
     * Sets the decorated flag.
     */
    public function setDecorated(bool $decorated);
    /**
     * Gets the decorated flag.
     *
     * @return bool true if the output will decorate messages, false otherwise
     */
    public function isDecorated();
    /**
     * Sets a new style.
     */
    public function setStyle(string $name, \_PhpScoper61d2aa534566\Symfony\Component\Console\Formatter\OutputFormatterStyleInterface $style);
    /**
     * Checks if output formatter has style with specified name.
     *
     * @return bool
     */
    public function hasStyle(string $name);
    /**
     * Gets style options from style with specified name.
     *
     * @return OutputFormatterStyleInterface
     *
     * @throws \InvalidArgumentException When style isn't defined
     */
    public function getStyle(string $name);
    /**
     * Formats a message according to the given styles.
     */
    public function format(?string $message);
}
