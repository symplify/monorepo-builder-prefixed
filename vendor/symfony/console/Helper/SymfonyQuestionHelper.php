<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\Console\Helper;

use _PhpScoper36281e29f54f\Symfony\Component\Console\Formatter\OutputFormatter;
use _PhpScoper36281e29f54f\Symfony\Component\Console\Output\OutputInterface;
use _PhpScoper36281e29f54f\Symfony\Component\Console\Question\ChoiceQuestion;
use _PhpScoper36281e29f54f\Symfony\Component\Console\Question\ConfirmationQuestion;
use _PhpScoper36281e29f54f\Symfony\Component\Console\Question\Question;
use _PhpScoper36281e29f54f\Symfony\Component\Console\Style\SymfonyStyle;
/**
 * Symfony Style Guide compliant question helper.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class SymfonyQuestionHelper extends \_PhpScoper36281e29f54f\Symfony\Component\Console\Helper\QuestionHelper
{
    /**
     * {@inheritdoc}
     */
    protected function writePrompt(\_PhpScoper36281e29f54f\Symfony\Component\Console\Output\OutputInterface $output, \_PhpScoper36281e29f54f\Symfony\Component\Console\Question\Question $question)
    {
        $text = \_PhpScoper36281e29f54f\Symfony\Component\Console\Formatter\OutputFormatter::escapeTrailingBackslash($question->getQuestion());
        $default = $question->getDefault();
        switch (\true) {
            case null === $default:
                $text = \sprintf(' <info>%s</info>:', $text);
                break;
            case $question instanceof \_PhpScoper36281e29f54f\Symfony\Component\Console\Question\ConfirmationQuestion:
                $text = \sprintf(' <info>%s (yes/no)</info> [<comment>%s</comment>]:', $text, $default ? 'yes' : 'no');
                break;
            case $question instanceof \_PhpScoper36281e29f54f\Symfony\Component\Console\Question\ChoiceQuestion && $question->isMultiselect():
                $choices = $question->getChoices();
                $default = \explode(',', $default);
                foreach ($default as $key => $value) {
                    $default[$key] = $choices[\trim($value)];
                }
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \_PhpScoper36281e29f54f\Symfony\Component\Console\Formatter\OutputFormatter::escape(\implode(', ', $default)));
                break;
            case $question instanceof \_PhpScoper36281e29f54f\Symfony\Component\Console\Question\ChoiceQuestion:
                $choices = $question->getChoices();
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \_PhpScoper36281e29f54f\Symfony\Component\Console\Formatter\OutputFormatter::escape(isset($choices[$default]) ? $choices[$default] : $default));
                break;
            default:
                $text = \sprintf(' <info>%s</info> [<comment>%s</comment>]:', $text, \_PhpScoper36281e29f54f\Symfony\Component\Console\Formatter\OutputFormatter::escape($default));
        }
        $output->writeln($text);
        if ($question instanceof \_PhpScoper36281e29f54f\Symfony\Component\Console\Question\ChoiceQuestion) {
            $width = \max(\array_map('strlen', \array_keys($question->getChoices())));
            foreach ($question->getChoices() as $key => $value) {
                $output->writeln(\sprintf("  [<comment>%-{$width}s</comment>] %s", $key, $value));
            }
        }
        $output->write(' > ');
    }
    /**
     * {@inheritdoc}
     */
    protected function writeError(\_PhpScoper36281e29f54f\Symfony\Component\Console\Output\OutputInterface $output, \Exception $error)
    {
        if ($output instanceof \_PhpScoper36281e29f54f\Symfony\Component\Console\Style\SymfonyStyle) {
            $output->newLine();
            $output->error($error->getMessage());
            return;
        }
        parent::writeError($output, $error);
    }
}
