<?php

// Script to remove comments from PHP files in the Laravel project
// Usage: php remove_comments.php

function removeComments($content) {
    // Remove multi-line comments (/* */)
    $content = preg_replace('/\/\*[\s\S]*?\*\//', '', $content);
    
    // Remove single-line comments (// and #)
    $content = preg_replace('/(^|\s)\/\/.*?$|#.*?$/m', '', $content);
    
    // Remove empty lines that might be left after comment removal
    $content = preg_replace('/^\s*\n/m', '', $content);
    
    return $content;
}

function processDirectory($dir) {
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($path)) {
            // Skip vendor and node_modules directories
            if ($file === 'vendor' || $file === 'node_modules') {
                echo "Skipping directory: $path\n";
                continue;
            }
            
            processDirectory($path);
        } else if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
            echo "Processing file: $path\n";
            
            $content = file_get_contents($path);
            $newContent = removeComments($content);
            
            if ($content !== $newContent) {
                file_put_contents($path, $newContent);
                echo "  Comments removed\n";
            } else {
                echo "  No comments found\n";
            }
        }
    }
}

// Start processing from the project root
$rootDir = __DIR__;
echo "Starting to remove comments from PHP files in: $rootDir\n";
processDirectory($rootDir);

echo "Comment removal process completed!\n";
