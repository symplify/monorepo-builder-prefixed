<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\Console;

use _PhpScoperc4f6ca029880\Nette\Utils\Strings;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Application;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Command\Command;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Descriptor\TextDescriptor;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Exception\RuntimeException;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Input\InputInterface;
use _PhpScoperc4f6ca029880\Symfony\Component\Console\Output\OutputInterface;
use Symplify\PackageBuilder\Console\Command\CommandNaming;
use Symplify\PackageBuilder\Console\ShellCode;
abstract class AbstractSymplifyConsoleApplication extends \_PhpScoperc4f6ca029880\Symfony\Component\Console\Application
{
    /**
     * @var string
     */
    private const COMMAND = 'command';
    /**
     * Add names to all commands by class-name convention
     * @param Command[] $commands
     */
    public function addCommands(array $commands) : void
    {
        $commandNaming = new \Symplify\PackageBuilder\Console\Command\CommandNaming();
        foreach ($commands as $command) {
            $commandName = $commandNaming->resolveFromCommand($command);
            $command->setName($commandName);
        }
        parent::addCommands($commands);
    }
    protected function doRunCommand(\_PhpScoperc4f6ca029880\Symfony\Component\Console\Command\Command $command, \_PhpScoperc4f6ca029880\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoperc4f6ca029880\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        return $this->doRunCommandAndShowHelpOnArgumentError($command, $input, $output);
    }
    protected function doRunCommandAndShowHelpOnArgumentError(\_PhpScoperc4f6ca029880\Symfony\Component\Console\Command\Command $command, \_PhpScoperc4f6ca029880\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoperc4f6ca029880\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        try {
            return parent::doRunCommand($command, $input, $output);
        } catch (\_PhpScoperc4f6ca029880\Symfony\Component\Console\Exception\RuntimeException $runtimeException) {
            if (\_PhpScoperc4f6ca029880\Nette\Utils\Strings::contains($runtimeException->getMessage(), 'Provide required arguments')) {
                $this->cleanExtraCommandArgument($command);
                $textDescriptor = new \_PhpScoperc4f6ca029880\Symfony\Component\Console\Descriptor\TextDescriptor();
                $textDescriptor->describe($output, $command);
                return \Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
            }
            throw $runtimeException;
        }
    }
    /**
     * Sometimes there is "command" argument,
     * not really needed on fail of missing argument
     */
    private function cleanExtraCommandArgument(\_PhpScoperc4f6ca029880\Symfony\Component\Console\Command\Command $command) : void
    {
        $arguments = $command->getDefinition()->getArguments();
        if (!isset($arguments[self::COMMAND])) {
            return;
        }
        unset($arguments[self::COMMAND]);
        $command->getDefinition()->setArguments($arguments);
    }
}
