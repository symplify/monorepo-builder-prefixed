<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper31b05558ad5c\Symfony\Component\HttpKernel\DataCollector;

/**
 * LateDataCollectorInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface LateDataCollectorInterface
{
    /**
     * Collects data as late as possible.
     */
    public function lateCollect();
}
