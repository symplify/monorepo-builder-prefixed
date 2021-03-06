<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Merge\Tests\ComposerJsonDecorator\RootRemoveComposerJsonDecorator;

use Symplify\MonorepoBuilder\HttpKernel\MonorepoBuilderKernel;
use Symplify\MonorepoBuilder\Merge\ComposerJsonMerger;
use Symplify\MonorepoBuilder\Merge\Tests\ComposerJsonDecorator\AbstractComposerJsonDecoratorTest;
/**
 * @see \Symplify\MonorepoBuilder\Merge\ComposerJsonDecorator\RootRemoveComposerJsonDecorator
 */
final class RootRemoveComposerJsonDecoratorTest extends \Symplify\MonorepoBuilder\Merge\Tests\ComposerJsonDecorator\AbstractComposerJsonDecoratorTest
{
    /**
     * @var ComposerJsonMerger
     */
    private $composerJsonMerger;
    protected function setUp() : void
    {
        parent::setUp();
        $this->bootKernel(\Symplify\MonorepoBuilder\HttpKernel\MonorepoBuilderKernel::class);
        $this->composerJsonMerger = $this->getService(\Symplify\MonorepoBuilder\Merge\ComposerJsonMerger::class);
    }
    /**
     * Only packages collected from /packages directory should be removed
     */
    public function test() : void
    {
        $composerJson = $this->composerJsonFactory->createFromFilePath(__DIR__ . '/Source/composer.json');
        $extraComposerJson = $this->composerJsonFactory->createFromFilePath(__DIR__ . '/Source/packages/composer.json');
        $this->composerJsonMerger->mergeJsonToRoot($composerJson, $extraComposerJson);
        $expectedComposerJson = $this->composerJsonFactory->createFromFilePath(__DIR__ . '/Source/expected-composer.json');
        $this->assertComposerJsonEquals($expectedComposerJson, $composerJson);
    }
}
