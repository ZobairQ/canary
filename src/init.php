<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 15-12-2016
 * Time: 23:05
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/Canary/src/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Canary/lib/vendor/autoload.php");


error_reporting(E_ALL);
ini_set("display_errors", 1);
use Illuminate\Database\Capsule\Manager as Capsule;

function setupTheDatabase(){
    $capsule = new Capsule();
    $capsule->addConnection([
        "driver" => $GLOBALS['config']['Databases']['MainDatabase']['DatabaseType'],
        "host" => $GLOBALS['config']['Databases']['MainDatabase']['Host'],
        "database" =>$GLOBALS['config']['Databases']['MainDatabase']['DatabaseName'],
        "username" => $GLOBALS['config']['Databases']['MainDatabase']['Username'],
        "password" => $GLOBALS['config']['Databases']['MainDatabase']['Password'],
        "charset" => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ]);

    $capsule->bootEloquent();
}

function startRouting()
{
    if (isset($_GET['page'])) {
        $path = $_GET['page'];
        $router = Router::getInstance();
        $router->Route($path);

    } else {
        echo $_SERVER['REQUEST_URI'];
        echo "Don't know what to do";
        $_GET['page'] = "home";
        startRouting();
    }
}

setupTheDatabase();
startRouting();
