<?php

declare (strict_types=1);
namespace Symplify\ConsoleColorDiff\Diff\Output;

use _PhpScoperaff2103cee1d\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use Symplify\PackageBuilder\Reflection\PrivatesAccessor;
/**
 * Creates @see UnifiedDiffOutputBuilder with "$contextLines = 1000;"
 */
final class CompleteUnifiedDiffOutputBuilderFactory
{
    /**
     * @var PrivatesAccessor
     */
    private $privatesAccessor;
    public function __construct(\Symplify\PackageBuilder\Reflection\PrivatesAccessor $privatesAccessor)
    {
        $this->privatesAccessor = $privatesAccessor;
    }
    /**
     * @api
     */
    public function create() : \_PhpScoperaff2103cee1d\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder
    {
        $unifiedDiffOutputBuilder = new \_PhpScoperaff2103cee1d\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder('');
        $this->privatesAccessor->setPrivateProperty($unifiedDiffOutputBuilder, 'contextLines', 10000);
        return $unifiedDiffOutputBuilder;
    }
}