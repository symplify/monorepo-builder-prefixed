<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */
declare (strict_types=1);
namespace _PhpScoper36281e29f54f\Nette\Utils;

use _PhpScoper36281e29f54f\Nette;
/**
 * File system tool.
 */
final class FileSystem
{
    use Nette\StaticClass;
    /**
     * Creates a directory.
     * @throws Nette\IOException
     */
    public static function createDir(string $dir, int $mode = 0777) : void
    {
        if (!\is_dir($dir) && !@\mkdir($dir, $mode, \true) && !\is_dir($dir)) {
            // @ - dir may already exist
            throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to create directory '{$dir}'. " . self::getLastError());
        }
    }
    /**
     * Copies a file or directory.
     * @throws Nette\IOException
     */
    public static function copy(string $source, string $dest, bool $overwrite = \true) : void
    {
        if (\stream_is_local($source) && !\file_exists($source)) {
            throw new \_PhpScoper36281e29f54f\Nette\IOException("File or directory '{$source}' not found.");
        } elseif (!$overwrite && \file_exists($dest)) {
            throw new \_PhpScoper36281e29f54f\Nette\InvalidStateException("File or directory '{$dest}' already exists.");
        } elseif (\is_dir($source)) {
            static::createDir($dest);
            foreach (new \FilesystemIterator($dest) as $item) {
                static::delete($item->getPathname());
            }
            foreach ($iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST) as $item) {
                if ($item->isDir()) {
                    static::createDir($dest . '/' . $iterator->getSubPathName());
                } else {
                    static::copy($item->getPathname(), $dest . '/' . $iterator->getSubPathName());
                }
            }
        } else {
            static::createDir(\dirname($dest));
            if (($s = @\fopen($source, 'r')) && ($d = @\fopen($dest, 'w')) && @\stream_copy_to_stream($s, $d) === \false) {
                // @ is escalated to exception
                throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to copy file '{$source}' to '{$dest}'. " . self::getLastError());
            }
        }
    }
    /**
     * Deletes a file or directory.
     * @throws Nette\IOException
     */
    public static function delete(string $path) : void
    {
        if (\is_file($path) || \is_link($path)) {
            $func = \DIRECTORY_SEPARATOR === '\\' && \is_dir($path) ? 'rmdir' : 'unlink';
            if (!@$func($path)) {
                // @ is escalated to exception
                throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to delete '{$path}'. " . self::getLastError());
            }
        } elseif (\is_dir($path)) {
            foreach (new \FilesystemIterator($path) as $item) {
                static::delete($item->getPathname());
            }
            if (!@\rmdir($path)) {
                // @ is escalated to exception
                throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to delete directory '{$path}'. " . self::getLastError());
            }
        }
    }
    /**
     * Renames a file or directory.
     * @throws Nette\IOException
     * @throws Nette\InvalidStateException if the target file or directory already exist
     */
    public static function rename(string $name, string $newName, bool $overwrite = \true) : void
    {
        if (!$overwrite && \file_exists($newName)) {
            throw new \_PhpScoper36281e29f54f\Nette\InvalidStateException("File or directory '{$newName}' already exists.");
        } elseif (!\file_exists($name)) {
            throw new \_PhpScoper36281e29f54f\Nette\IOException("File or directory '{$name}' not found.");
        } else {
            static::createDir(\dirname($newName));
            if (\realpath($name) !== \realpath($newName)) {
                static::delete($newName);
            }
            if (!@\rename($name, $newName)) {
                // @ is escalated to exception
                throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to rename file or directory '{$name}' to '{$newName}'. " . self::getLastError());
            }
        }
    }
    /**
     * Reads file content.
     * @throws Nette\IOException
     */
    public static function read(string $file) : string
    {
        $content = @\file_get_contents($file);
        // @ is escalated to exception
        if ($content === \false) {
            throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to read file '{$file}'. " . self::getLastError());
        }
        return $content;
    }
    /**
     * Writes a string to a file.
     * @throws Nette\IOException
     */
    public static function write(string $file, string $content, ?int $mode = 0666) : void
    {
        static::createDir(\dirname($file));
        if (@\file_put_contents($file, $content) === \false) {
            // @ is escalated to exception
            throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to write file '{$file}'. " . self::getLastError());
        }
        if ($mode !== null && !@\chmod($file, $mode)) {
            // @ is escalated to exception
            throw new \_PhpScoper36281e29f54f\Nette\IOException("Unable to chmod file '{$file}'. " . self::getLastError());
        }
    }
    /**
     * Is path absolute?
     */
    public static function isAbsolute(string $path) : bool
    {
        return (bool) \preg_match('#([a-z]:)?[/\\\\]|[a-z][a-z0-9+.-]*://#Ai', $path);
    }
    private static function getLastError() : string
    {
        return \preg_replace('#^\\w+\\(.*?\\): #', '', \error_get_last()['message']);
    }
}
