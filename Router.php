<?php

use Symfony\Component\Yaml\Yaml;
use Tracy\Debugger;
use TYPO3Fluid\Fluid\View\TemplateView;

{
    require_once 'Setup.inc';

    $publicRoot = sprintf('%s%s%s', $workingDirectory, DIRECTORY_SEPARATOR, trim($_ENV['SAFES_PUBLIC_ROOT'], '/\\') ?? '_public');

    $requestUri = trim($_SERVER['REQUEST_URI'], '/');

    {
        // Request to asset

        $file = sprintf('%s/%s', $publicRoot, $requestUri);

        if (is_file($file)) {
            return false;
        }
    }

    {
        // Render page

        $pageFile = sprintf('%s%s%s', $pagesRoot, DIRECTORY_SEPARATOR, str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $requestUri));

        if (is_file($pageFile)) {
            /** @var TemplateView $view */

            $templateName = pathinfo($pageFile, PATHINFO_FILENAME);

            {
                // Data source

                $templateName = pathinfo($pageFile, PATHINFO_FILENAME);
                $dataFile = sprintf('%s%s%s.html.yml', $pagesRoot, DIRECTORY_SEPARATOR, $templateName);

                if (is_file($dataFile)) {
                    $data = Yaml::parseFile($dataFile);
                    Debugger::barDump($data);

                    if (!empty($data)) {
                        $view->assignMultiple($data);
                    }
                }
            }

            $view->assign('debugger', $debugger);

            echo $view->render($templateName);

            return true;
        }
    }

    {
        // Overview of available pages

        $files = glob(sprintf('%s/*.html', $pagesRoot));

        $pages = [];

        foreach ($files as $file) {
            $filename = basename($file);
            $name = pathinfo($filename, PATHINFO_FILENAME);
            $pages[] = sprintf('<li><a href="/%s" target="%s">%s</a></li>', $filename, md5($file), ucfirst($name));
        }

        $template = file_get_contents(__DIR__ .DIRECTORY_SEPARATOR . 'Index.html');
        echo sprintf($template, $_ENV['SAFES_PROJECT_NAME'], $debugger, implode("\n", $pages));
    }
}
