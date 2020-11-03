<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper2a80719fd449\PharIo\Version;

class AndVersionConstraintGroup extends \_PhpScoper2a80719fd449\PharIo\Version\AbstractVersionConstraint
{
    /**
     * @var VersionConstraint[]
     */
    private $constraints = [];
    /**
     * @param string $originalValue
     * @param VersionConstraint[] $constraints
     */
    public function __construct($originalValue, array $constraints)
    {
        parent::__construct($originalValue);
        $this->constraints = $constraints;
    }
    /**
     * @param Version $version
     *
     * @return bool
     */
    public function complies(\_PhpScoper2a80719fd449\PharIo\Version\Version $version)
    {
        foreach ($this->constraints as $constraint) {
            if (!$constraint->complies($version)) {
                return \false;
            }
        }
        return \true;
    }
}