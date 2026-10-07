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

            // Split by lines and rebuild without .query methods
            $lines = explode("\n", $content);
            $output = [];
            $skipUntilEnd = false;
            $braceCount = 0;

            foreach ($lines as $line) {
                // Check if this line starts a .query method
                if (preg_match('/^\s*\w+\.query\s*=\s*\(/', $line)) {
                    $skipUntilEnd = true;
                    $braceCount = 0;
                    // Count braces to know when method ends
                    $braceCount += substr_count($line, '{') - substr_count($line, '}');
                    continue;
                }

                if ($skipUntilEnd) {
                    // Update brace count
                    $braceCount += substr_count($line, '{') - substr_count($line, '}');

                    // If we've closed all braces, we're done with this method
                    if ($braceCount <= 0) {
                        $skipUntilEnd = false;
                        // Skip this line and the next empty line
                        continue;
                    }
                    continue;
                }

                $output[] = $line;
            }

            $newContent = implode("\n", $output);

            if ($newContent !== $original) {
                file_put_contents($path, $newContent);
                echo "Fixed: $path\n";
            }
        }
    }
}

removeInvalidQueryMethods($basePath);
echo "Done fixing Wayfinder files!\n";
