<?php

declare (strict_types=1);
namespace Symplify\SymplifyKernel\Console;

use _PhpScoper503cab241f82\Nette\Utils\Strings;
use _PhpScoper503cab241f82\Symfony\Component\Console\Application;
use _PhpScoper503cab241f82\Symfony\Component\Console\Command\Command;
use _PhpScoper503cab241f82\Symfony\Component\Console\Descriptor\TextDescriptor;
use _PhpScoper503cab241f82\Symfony\Component\Console\Exception\RuntimeException;
use _PhpScoper503cab241f82\Symfony\Component\Console\Input\InputInterface;
use _PhpScoper503cab241f82\Symfony\Component\Console\Output\OutputInterface;
use Symplify\PackageBuilder\Console\Command\CommandNaming;
use Symplify\PackageBuilder\Console\ShellCode;
abstract class AbstractSymplifyConsoleApplication extends \_PhpScoper503cab241f82\Symfony\Component\Console\Application
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
    protected function doRunCommand(\_PhpScoper503cab241f82\Symfony\Component\Console\Command\Command $command, \_PhpScoper503cab241f82\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper503cab241f82\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        return $this->doRunCommandAndShowHelpOnArgumentError($command, $input, $output);
    }
    protected function doRunCommandAndShowHelpOnArgumentError(\_PhpScoper503cab241f82\Symfony\Component\Console\Command\Command $command, \_PhpScoper503cab241f82\Symfony\Component\Console\Input\InputInterface $input, \_PhpScoper503cab241f82\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        try {
            return parent::doRunCommand($command, $input, $output);
        } catch (\_PhpScoper503cab241f82\Symfony\Component\Console\Exception\RuntimeException $runtimeException) {
            if (\_PhpScoper503cab241f82\Nette\Utils\Strings::contains($runtimeException->getMessage(), 'Provide required arguments')) {
                $this->cleanExtraCommandArgument($command);
                $textDescriptor = new \_PhpScoper503cab241f82\Symfony\Component\Console\Descriptor\TextDescriptor();
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
    private function cleanExtraCommandArgument(\_PhpScoper503cab241f82\Symfony\Component\Console\Command\Command $command) : void
    {
        $arguments = $command->getDefinition()->getArguments();
        if (!isset($arguments[self::COMMAND])) {
            return;
        }
        unset($arguments[self::COMMAND]);
        $command->getDefinition()->setArguments($arguments);
    }
}
