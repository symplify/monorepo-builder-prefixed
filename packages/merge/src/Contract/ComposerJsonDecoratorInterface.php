<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Merge\Contract;

use Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
interface ComposerJsonDecoratorInterface
{
    public function decorate(\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson $composerJson) : void;
}
