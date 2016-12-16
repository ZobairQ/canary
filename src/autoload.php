<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 19:38
 */
require($_SERVER['DOCUMENT_ROOT'] . "/Canary/src/config.php");
$allDir = [];

spl_autoload_register(function ($className) {

  /*  $libPath = $GLOBALS['config']['Path']['Lib'];
    $srcPath = $GLOBALS['config']['Path']["Src"];
    $appPath = $GLOBALS['config']['Path']["App"];
    $controllerPath = $GLOBALS['config']['Path']["Controllers"];
    $modelPath = $GLOBALS['config']['Path']["Models"];
    $templatePath = $GLOBALS['config']['Path']["Templates"];
    $platesSrcPath = $GLOBALS['config']['Path']["PlatesSrc"];
    $platesTemplatePath = $GLOBALS['config']['Path']["PlatesTemplate"];
    $platesExtensionPath = $GLOBALS['config']['Path']["PlatesExtension"];*/

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

    //Legacy Code

    /* if(file_exists("{$libPath}$className.php")){
         require("{$libPath}$className.php");
     }elseif (file_exists("{$srcPath}$className.php")){
         require("{$srcPath}$className.php");
     }elseif (file_exists("{$appPath}$className.php")) {
         require("{$appPath}$className.php");
     }elseif (file_exists("{$controllerPath}$className.php")) {
         require("{$controllerPath}$className.php");
     }elseif (file_exists("{$modelPath}$className.php")) {
         require("{$modelPath}$className.php");
     }elseif (file_exists("{$templatePath}$className.php")) {
         require("{$templatePath}$className.php");
     }elseif (file_exists("{$platesSrcPath}$className.php")) {
         require("{$platesSrcPath}$className.php");
     }elseif (file_exists("{$platesTemplatePath}$className.php")) {
         require("{$platesTemplatePath}$className.php");
     }elseif (file_exists("{$platesExtensionPath}$className.php")) {
         require("{$platesExtensionPath}$className.php");
     }*/
});


function constructFolders()
{
    //TODO: only 5 layers folder support!
    $dirs = glob($_SERVER['DOCUMENT_ROOT'] . '/Canary/*', GLOB_ONLYDIR);

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
