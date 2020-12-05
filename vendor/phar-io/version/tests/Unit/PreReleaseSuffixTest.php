<?php

namespace _PhpScoperd607abf1de8e\PharIo\Version;

use _PhpScoperd607abf1de8e\PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Version\PreReleaseSuffix
 */
class PreReleaseSuffixTest extends \_PhpScoperd607abf1de8e\PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider greaterThanProvider
     *
     * @param string $leftSuffixValue
     * @param string $rightSuffixValue
     * @param bool $expectedResult
     */
    public function testGreaterThanReturnsExpectedResult($leftSuffixValue, $rightSuffixValue, $expectedResult)
    {
        $leftSuffix = new \_PhpScoperd607abf1de8e\PharIo\Version\PreReleaseSuffix($leftSuffixValue);
        $rightSuffix = new \_PhpScoperd607abf1de8e\PharIo\Version\PreReleaseSuffix($rightSuffixValue);
        $this->assertSame($expectedResult, $leftSuffix->isGreaterThan($rightSuffix));
    }
    public function greaterThanProvider()
    {
        return [['alpha1', 'alpha2', \false], ['alpha2', 'alpha1', \true], ['beta1', 'alpha3', \true], ['b1', 'alpha3', \true], ['b1', 'a3', \true], ['dev1', 'alpha2', \false], ['dev1', 'alpha2', \false], ['alpha2', 'dev5', \true], ['rc1', 'beta2', \true], ['patch5', 'rc7', \true], ['alpha1', 'alpha.2', \false], ['alpha.3', 'alpha2', \true], ['alpha.3', 'alpha.2', \true]];
    }
}
