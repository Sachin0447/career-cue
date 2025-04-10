<?php

// Function to recursively go through each directory and file
function replaceInFiles($directory) {
    // Open the directory
    $dir = opendir($directory);

    if (!$dir) {
        die("Unable to open directory: $directory");
    }

    // Loop through the files in the directory
    while (($file = readdir($dir)) !== false) {
        // Skip '.' and '..' directories
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Full path of the current file or directory
        $filePath = $directory . DIRECTORY_SEPARATOR . $file;

        // If it's a directory, call the function recursively
        if (is_dir($filePath)) {
            replaceInFiles($filePath);
        } else {
            // If it's a file, process it
            processFile($filePath);
        }
    }

    // Close the directory
    closedir($dir);
}

// Function to process each file and replace the text
function processFile($filePath) {
    // Check if it's a file and if it's readable
    if (is_file($filePath) && is_readable($filePath)) {
        // Get the file contents
        $fileContents = file_get_contents($filePath);

        // If the string "Nightingale Jobs" is found, replace it
        $text = '#33B6CB';
        $rep = '#33B6CB';


        if (strpos($fileContents, $text) !== false) {
            // Replace the text with "CareerCue"
            $updatedContents = str_replace($text, $rep, $fileContents);

            // Write the updated content back to the file
            file_put_contents($filePath, $updatedContents);
            echo "Updated file: $filePath\n";
        }
    }
}

// Get the current directory where the script is located
$directoryPath = getcwd(); // This gets the current working directory

// Start replacing in files
replaceInFiles($directoryPath);

?>
