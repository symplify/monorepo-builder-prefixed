<?php

declare (strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScopere6d124d1f7ba\SebastianBergmann\Diff;

interface LongestCommonSubsequenceCalculator
{
    /**
     * Calculates the longest common subsequence of two arrays.
     */
    public function calculate(array $from, array $to) : array;
}
