<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScopercd844fca8af3\Symfony\Component\Console\Event;

use _PhpScopercd844fca8af3\Symfony\Component\Console\Command\Command;
use _PhpScopercd844fca8af3\Symfony\Component\Console\Input\InputInterface;
use _PhpScopercd844fca8af3\Symfony\Component\Console\Output\OutputInterface;
use _PhpScopercd844fca8af3\Symfony\Component\EventDispatcher\Event;
/**
 * Allows to inspect input and output of a command.
 *
 * @author Francesco Levorato <git@flevour.net>
 */
class ConsoleEvent extends \_PhpScopercd844fca8af3\Symfony\Component\EventDispatcher\Event
{
    protected $command;
    private $input;
    private $output;
    public function __construct(\_PhpScopercd844fca8af3\Symfony\Component\Console\Command\Command $command = null, \_PhpScopercd844fca8af3\Symfony\Component\Console\Input\InputInterface $input, \_PhpScopercd844fca8af3\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->command = $command;
        $this->input = $input;
        $this->output = $output;
    }
    /**
     * Gets the command that is executed.
     *
     * @return Command|null A Command instance
     */
    public function getCommand()
    {
        return $this->command;
    }
    /**
     * Gets the input instance.
     *
     * @return InputInterface An InputInterface instance
     */
    public function getInput()
    {
        return $this->input;
    }
    /**
     * Gets the output instance.
     *
     * @return OutputInterface An OutputInterface instance
     */
    public function getOutput()
    {
        return $this->output;
    }
}
