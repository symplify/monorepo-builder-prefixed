<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper66a1b4bf441c\PharIo\Version;

class GreaterThanOrEqualToVersionConstraint extends \_PhpScoper66a1b4bf441c\PharIo\Version\AbstractVersionConstraint
{
    /**
     * @var Version
     */
    private $minimalVersion;
    /**
     * @param string $originalValue
     * @param Version $minimalVersion
     */
    public function __construct($originalValue, \_PhpScoper66a1b4bf441c\PharIo\Version\Version $minimalVersion)
    {
        parent::__construct($originalValue);
        $this->minimalVersion = $minimalVersion;
    }
    /**
     * @param Version $version
     *
     * @return bool
     */
    public function complies(\_PhpScoper66a1b4bf441c\PharIo\Version\Version $version)
    {
        return $version->getVersionString() == $this->minimalVersion->getVersionString() || $version->isGreaterThan($this->minimalVersion);
    }
}
