<?php

declare (strict_types=1);
namespace Symplify\ConsoleColorDiff\Console\Output;

use _PhpScoper450cfab1c22b\SebastianBergmann\Diff\Differ;
use _PhpScoper450cfab1c22b\Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\ConsoleColorDiff\Console\Formatter\ColorConsoleDiffFormatter;
final class ConsoleDiffer
{
    /**
     * @var Differ
     */
    private $differ;
    /**
     * @var SymfonyStyle
     */
    private $symfonyStyle;
    /**
     * @var ColorConsoleDiffFormatter
     */
    private $colorConsoleDiffFormatter;
    public function __construct(\_PhpScoper450cfab1c22b\Symfony\Component\Console\Style\SymfonyStyle $symfonyStyle, \_PhpScoper450cfab1c22b\SebastianBergmann\Diff\Differ $differ, \Symplify\ConsoleColorDiff\Console\Formatter\ColorConsoleDiffFormatter $colorConsoleDiffFormatter)
    {
        $this->symfonyStyle = $symfonyStyle;
        $this->differ = $differ;
        $this->colorConsoleDiffFormatter = $colorConsoleDiffFormatter;
    }
    public function diff(string $old, string $new) : string
    {
        $diff = $this->differ->diff($old, $new);
        return $this->colorConsoleDiffFormatter->format($diff);
    }
    public function diffAndPrint(string $old, string $new) : void
    {
        $formattedDiff = $this->diff($old, $new);
        $this->symfonyStyle->writeln($formattedDiff);
    }
}
