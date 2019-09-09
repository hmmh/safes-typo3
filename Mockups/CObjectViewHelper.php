<?php
namespace TYPO3\CMS\Fluid\ViewHelpers;

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

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class CObjectViewHelper extends AbstractViewHelper
{
    /**
     * Disable escaping of child nodes' output
     *
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * Disable escaping of this node's output
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('typoscriptObjectPath', 'string', 'the TypoScript setup path of the TypoScript object to render', true);
        $this->registerArgument('data', 'mixed', 'the data to be used for rendering the cObject. Can be an object, array or string. If this argument is not set, child nodes will be used');
        $this->registerArgument('currentValueKey', 'string', 'currentValueKey');
        $this->registerArgument('table', 'string', 'the table name associated with "data" argument. Typically tt_content or one of your custom tables. This argument should be set if rendering a FILES cObject where file references are used, or if the data argument is a database record.', false, '');
    }

    /**
     * Renders the TypoScript object in the given TypoScript setup path.
     *
     * @return string the content of the rendered TypoScript object
     */
    public function render()
    {
        return sprintf('<!-- CObject "%s" -->', $this->arguments['typoscriptObjectPath']);
    }
}
