<?php
function listFiles($dir)
{
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . '/' . $file;
        echo $path . "<br>";
        if (is_dir($path)) {
            listFiles($path);
        }
    }
}
listFiles(__DIR__);
