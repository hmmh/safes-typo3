<?php namespace HMMH\SAFES;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Composer\Script\Event;

/**
 * Class DeveloperHelper
 *
 */
class DeveloperHelper
{
    const COMMAND = 'safes';

    protected static function getHeader(): void
    {
        // FIGlet
        echo <<<ANSI_SHADOW

    ███████╗ █████╗ ███████╗███████╗███████╗    ██╗  ██╗    ████████╗██╗   ██╗██████╗  ██████╗ ██████╗     S tand
    ██╔════╝██╔══██╗██╔════╝██╔════╝██╔════╝    ██║  ██║    ╚══██╔══╝╚██╗ ██╔╝██╔══██╗██╔═══██╗╚════██╗    A lone
    ███████╗███████║█████╗  █████╗  ███████╗    ███████║       ██║    ╚████╔╝ ██████╔╝██║   ██║ █████╔╝    F ront
    ╚════██║██╔══██║██╔══╝  ██╔══╝  ╚════██║    ╚════██║       ██║     ╚██╔╝  ██╔═══╝ ██║   ██║ ╚═══██╗    E nd
    ███████║██║  ██║██║     ███████╗███████║         ██║       ██║      ██║   ██║     ╚██████╔╝██████╔╝    S tage
    ╚══════╝╚═╝  ╚═╝╚═╝     ╚══════╝╚══════╝         ╚═╝       ╚═╝      ╚═╝   ╚═╝      ╚═════╝ ╚═════╝     4TYPO3

ANSI_SHADOW;
    }

    /**
     * @param array $messages
     */
    protected static function getBox(string ...$messages): void
    {
        echo "\n";
        echo sprintf('    #%s#%s', str_repeat('#', 30), "\n");

        foreach ($messages as $message) {
            echo sprintf('    # %s #%s', str_pad($message, 28), "\n");
        }

        echo sprintf('    #%s#%s', str_repeat('#', 30), "\n");
        echo "\n";
    }

    /**
     * @param Event $event
     *
     * @return int
     */
    public static function runSafes(Event $event): int
    {
        static::getHeader();
        static::getBox('Run:', sprintf('$ %s', static::getCommand(getenv('PATH'))));

        return 0;
    }

    /**
     * @param string $pathEnvironment
     *
     * @return string
     */
    protected static function getCommand(string $pathEnvironment): string
    {
        if ($binary = static::findCommand(static::getPaths($pathEnvironment))) {
            if (is_executable($binary)) {
                $command = static::COMMAND;
            } else {
                $command = sprintf('composer exec %s', static::COMMAND);
            }
        } else {
            $binary = sprintf('%s/vendor/bin/%s', getcwd(), static::COMMAND);

            if (!is_file($binary)) {
                $binary = sprintf('%s/bin/%s', getcwd(), static::COMMAND);

                if (!is_file($binary)) {
                    $command = '<binary not found>';
                } else {
                    $command = sprintf('php bin/%s', static::COMMAND);
                }
            } else {
                $command = sprintf('composer exec %s', static::COMMAND);
            }
        }

        return $command;
    }

    /**
     * @param array $paths
     *
     * @return string|null
     */
    protected static function findCommand(array $paths): ?string
    {
        $found = null;

        foreach ($paths as $path) {
            $binary = sprintf('%s/%s', rtrim($path, '/'), static::COMMAND);

            if (is_file($binary)) {
                $found = $binary;
                break;
            }
        }

        return $found;
    }

    /**
     * @param string $path
     *
     * @return array
     */
    protected static function getPaths(string $path): array
    {
        return explode((('\\' === DIRECTORY_SEPARATOR) ? ';' : ':'), $path);
    }

    /**
     * @param Event $event
     *
     * @return int
     */
    public static function openBrowser(Event $event): int
    {
        static::getHeader();
        static::getBox('Open:', 'http://127.0.0.1:8080');

        return 0;
    }
}
