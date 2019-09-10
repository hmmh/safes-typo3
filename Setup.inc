<?php

use Tracy\Debugger;
use TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper;
use TYPO3Fluid\Fluid\Core\Cache\SimpleFileCache;
use TYPO3Fluid\Fluid\View\TemplateView;

{
    require_once 'vendor/autoload.php';

    {
        // Working Directory

        $workingDirectory = realpath(
            __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array_fill(0, 3, '..'))
        );

        if (!$workingDirectory) {
            throw new Exception('Cannot find working directory!');
        }
    }

    {
        // Debugging

        $debugger = null;
        $development = (!empty($_ENV['SAFES_DEVELOPMENT']));

        if ($development) {
            session_start();
            ob_start();

            Debugger::enable(Debugger::DEVELOPMENT);
            Debugger::$showBar = true;
            Debugger::$strictMode = true;
            Debugger::$showLocation = true;
            Debugger::renderLoader();

            $debugger = ob_get_contents();

            ob_clean();
        }
    }

    {
        // Scaffolding

        $scaffolding = [
            $resourcesRoot = sprintf('%s%s%s', $workingDirectory, DIRECTORY_SEPARATOR, trim($_ENV['SAFES_RESOURCE_ROOT'], '/\\') ?? 'Resources'),
            $localizationsRoot = sprintf('%s%s%s', $resourcesRoot, DIRECTORY_SEPARATOR, '_Localizations'),

            $elementsRoot = sprintf('%s%s%s', $resourcesRoot, DIRECTORY_SEPARATOR, 'Elements'),

            $layoutsRoot = sprintf('%s%s%s', $resourcesRoot, DIRECTORY_SEPARATOR, 'Layouts'),
            $pagesRoot = sprintf('%s%s%s', $resourcesRoot, DIRECTORY_SEPARATOR, 'Pages'),

            $mockupsRoot = sprintf('%s%s%s', $resourcesRoot, DIRECTORY_SEPARATOR, '_Mockups'),
        ];

        foreach ($scaffolding as $folder) {
            (is_dir($folder)) ?: @mkdir($folder);
        }
    }

    $view = new TemplateView();

    {
        // Configuration

        $paths = $view->getTemplatePaths();
        $paths->setTemplateRootPaths([$pagesRoot]);
        $paths->setLayoutRootPaths([$layoutsRoot]);
        $paths->setPartialRootPaths([$elementsRoot, $mockupsRoot]);

        $view->getViewHelperResolver()->addNamespace('f', 'TYPO3\CMS\Fluid\ViewHelpers');

        {
            $localizationFile = sprintf('%s%s%s', $localizationsRoot, DIRECTORY_SEPARATOR, 'Frontend.xlf');

            if (is_file($localizationFile)) {
                TranslateViewHelper::setSourceFile($localizationFile);
            }
        }
    }

    {
        // Caching

        if (!empty($cacheRoot = $_ENV['SAFES_CACHE_ROOT'])) {
            $cacheDirectory = sprintf('%s%s%s', $workingDirectory, DIRECTORY_SEPARATOR, trim($cacheRoot, '/\\'));
            (is_dir($cacheDirectory)) ?: @mkdir($cacheDirectory);

            if ($cacheDirectory) {
                $view->setCache(new SimpleFileCache($cacheDirectory));
            }
        }
    }
}
