<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 19:38
 */
require($_SERVER['DOCUMENT_ROOT'] . $GLOBALS['projectConfig']['ProjectRoot'] . "/src/config.php");
$allDir = [];

spl_autoload_register(function ($className) {

    if (strpos($className, '\\') !== FALSE) {
        $class = explode("\\", $className);
        $className = end($class);
    }

    constructFolders();

    foreach ($GLOBALS['allDir'] as $dir) {
        if (file_exists("{$dir}/$className.php")) {
            require_once("{$dir}/$className.php");
        }
    }
});


function constructFolders()
{
    //TODO: only 5 layers folder support!
    $dirs = glob($_SERVER['DOCUMENT_ROOT'] . $GLOBALS['projectConfig']['ProjectRoot'] . '/*', GLOB_ONLYDIR);

    foreach ($dirs as $dir) {
        processPath($dir);
        foreach (glob($dir . '/*', GLOB_ONLYDIR) as $subs) {
            processPath($subs);
            foreach (glob($subs . '/*', GLOB_ONLYDIR) as $subs1) {
                processPath($subs1);
                foreach (glob($subs1 . '/*', GLOB_ONLYDIR) as $subs2) {
                    processPath($subs2);
                    foreach (glob($subs2 . '/*', GLOB_ONLYDIR) as $subs3) {
                        processPath($subs3);
                    }
                }
            }
        }
    }
}

function processPath($path)
{
    $key = makeKey($path);
    $GLOBALS['allDir'][$key] = $path;
}

function makeKey($givenString)
{
    $dirs = explode("/", $givenString);
    $curent = end($dirs);
    $parent = prev($dirs);

    return $parent . "@" . $curent;
}
