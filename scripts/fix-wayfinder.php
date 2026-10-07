<?php

/**
 * Fix invalid 'query' HTTP method in generated Wayfinder files
 */

$basePath = __DIR__ . '/../resources/js/actions';

function removeInvalidQueryMethods($dir) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            removeInvalidQueryMethods($path);
        } elseif (pathinfo($path, PATHINFO_EXTENSION) === 'ts') {
            $content = file_get_contents($path);
            $original = $content;

            // Remove all lines that have .query = (
            $content = preg_replace(
                '/^[A-Za-z0-9]*\.query\s*=\s*\([\s\S]*?\}\);?\n?/m',
                '',
                $content
            );

            if ($content !== $original) {
                file_put_contents($path, $content);
                echo "Fixed: $path\n";
            }
        }
    }
}

removeInvalidQueryMethods($basePath);
echo "Done fixing Wayfinder files!\n";
