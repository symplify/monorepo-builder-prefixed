<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper57793da194f3\PharIo\Version;

class SpecificMajorVersionConstraint extends \_PhpScoper57793da194f3\PharIo\Version\AbstractVersionConstraint
{
    /**
     * @var int
     */
    private $major = 0;
    /**
     * @param string $originalValue
     * @param int $major
     */
    public function __construct($originalValue, $major)
    {
        parent::__construct($originalValue);
        $this->major = $major;
    }
    /**
     * @param Version $version
     *
     * @return bool
     */
    public function complies(\_PhpScoper57793da194f3\PharIo\Version\Version $version)
    {
        return $version->getMajor()->getValue() == $this->major;
    }
}
