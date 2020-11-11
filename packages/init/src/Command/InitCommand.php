<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Init\Command;

use _PhpScoper416e75c46c6e\Jean85\PrettyVersions;
use _PhpScoper416e75c46c6e\Nette\Utils\Json as NetteJson;
use OutOfBoundsException;
use _PhpScoper416e75c46c6e\PharIo\Version\InvalidVersionException;
use _PhpScoper416e75c46c6e\PharIo\Version\Version;
use _PhpScoper416e75c46c6e\Symfony\Component\Console\Input\InputArgument;
use _PhpScoper416e75c46c6e\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper416e75c46c6e\Symfony\Component\Console\Output\OutputInterface;
use Symplify\MonorepoBuilder\ValueObject\File;
use Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand;
use Symplify\PackageBuilder\Console\ShellCode;
use function dirname;
final class InitCommand extends \Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand
{
    /**
     * @var string
     */
    private const OUTPUT = 'output';
    protected function configure() : void
    {
        $this->setDescription('Creates empty monorepo directory and composer.json structure.');
        $this->addArgument(self::OUTPUT, \_PhpScoper416e75c46c6e\Symfony\Component\Console\Input\InputArgument::OPTIONAL, 'Directory to generate monorepo into.', \getcwd());
    }
    protected function execute(\_PhpScoper416e75c46c6e\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper416e75c46c6e\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        /** @var string $output */
        $output = $input->getArgument(self::OUTPUT);
        $this->smartFileSystem->mirror(__DIR__ . '/../../templates/monorepo', $output);
        // Replace MonorepoBuilder version in monorepo-builder.php
        $filename = \sprintf('%s/%s', $output, \Symplify\MonorepoBuilder\ValueObject\File::CONFIG);
        $fileContent = $this->smartFileSystem->readFile($filename);
        $content = \str_replace('<version>', $this->getMonorepoBuilderVersion(), $fileContent);
        $this->smartFileSystem->dumpFile($filename, $content);
        $this->symfonyStyle->success('Congrats! Your first monorepo is here.');
        $message = \sprintf('Try the next step - merge "composer.json" files from packages to the root one:%s "vendor/bin/monorepo-builder merge"', \PHP_EOL);
        $this->symfonyStyle->note($message);
        return \Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
    }
    /**
     * Returns current version of MonorepoBuilder, contains only major and minor.
     */
    private function getMonorepoBuilderVersion() : string
    {
        $version = null;
        try {
            $prettyVersion = \_PhpScoper416e75c46c6e\Jean85\PrettyVersions::getVersion('symplify/monorepo-builder')->getPrettyVersion();
            $version = new \_PhpScoper416e75c46c6e\PharIo\Version\Version(\str_replace('x-dev', '0', $prettyVersion));
        } catch (\OutOfBoundsException|\_PhpScoper416e75c46c6e\PharIo\Version\InvalidVersionException $exceptoin) {
            // Version might not be explicitly set inside composer.json, looking for "vendor/composer/installed.json"
            $version = $this->extractMonorepoBuilderVersionFromComposer();
        }
        if ($version === null) {
            return 'Unknown';
        }
        return \sprintf('^%d.%d', $version->getMajor()->getValue(), $version->getMinor()->getValue());
    }
    /**
     * Returns current version of MonorepoBuilder extracting it from "vendor/composer/installed.json".
     */
    private function extractMonorepoBuilderVersionFromComposer() : ?\_PhpScoper416e75c46c6e\PharIo\Version\Version
    {
        $installedJsonFilename = \sprintf('%s/composer/installed.json', \dirname(__DIR__, 6));
        if (\is_file($installedJsonFilename)) {
            $installedJsonFileContent = $this->smartFileSystem->readFile($installedJsonFilename);
            $installedJson = \_PhpScoper416e75c46c6e\Nette\Utils\Json::decode($installedJsonFileContent);
            foreach ($installedJson as $installedPackage) {
                if ($installedPackage->name === 'symplify/monorepo-builder') {
                    return new \_PhpScoper416e75c46c6e\PharIo\Version\Version($installedPackage->version);
                }
            }
        }
        return null;
    }
}
