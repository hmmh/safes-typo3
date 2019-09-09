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
    /**
     * @param Event $event
     *
     * @return int
     */
    public static function composerServe(Event $event): int
    {
        echo implode(
            "\n",
            [
                '',
                '    #########################',
                '    # Run:                  #',
                '    # $ composer serve      #',
                '    #########################',
                '',
                '',
            ]
        );

        return 0;
    }

    /**
     * @param Event $event
     *
     * @return int
     */
    public static function openBrowser(Event $event): int
    {
        echo implode(
            "\n",
            [
                '',
                '    #########################',
                '    # Open:                 #',
                '    # http://127.0.0.1:8080 #',
                '    #########################',
                '',
                '',
            ]
        );

        return 0;
    }
}
