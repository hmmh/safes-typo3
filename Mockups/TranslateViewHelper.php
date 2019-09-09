<?php namespace TYPO3\CMS\Fluid\ViewHelpers;

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

use Closure;
use SimpleXMLElement;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 *
 *
 */
class TranslateViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var SimpleXMLElement
     */
    protected static $source;

    /**
     * @param string $file
     */
    public static function setSourceFile(string $file): void
    {
        static::$source = new SimpleXMLElement(file_get_contents($file));
    }

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('key', 'string', 'Translation Key');
    }

    /**
     * Return array element by key.
     *
     * @param array $arguments
     * @param Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $value = static::$source->xpath(sprintf('/xliff/file/body/trans-unit[@id="%s"]/source/text()', $arguments['key']));

        if (false === $value) {
            throw new Exception('Cannot find translate key <%s>', $arguments['key']);
        }

        return $value[0];
    }
}
