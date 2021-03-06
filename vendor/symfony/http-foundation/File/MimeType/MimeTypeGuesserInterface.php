<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\File\MimeType;

use _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use _PhpScoper36281e29f54f\Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use _PhpScoper36281e29f54f\Symfony\Component\Mime\MimeTypesInterface;
/**
 * Guesses the mime type of a file.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
 * @deprecated since Symfony 4.3, use {@link MimeTypesInterface} instead
 */
interface MimeTypeGuesserInterface
{
    /**
     * Guesses the mime type of the file with the given path.
     *
     * @param string $path The path to the file
     *
     * @return string|null The mime type or NULL, if none could be guessed
     *
     * @throws FileNotFoundException If the file does not exist
     * @throws AccessDeniedException If the file could not be read
     */
    public function guess($path);
}
