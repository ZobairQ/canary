<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 21:11
 */
class Router
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (Router::$instance == Null) {
            Router::$instance = new Router();
        }

        return Router::$instance;
    }

    public function Route($path)
    {
        if (strpos($path, "/") != null) {

            $pathSplit = explode("/", rtrim($path, "/"));
            $ensurance =
                [
                    "hasController" => false,
                    "hasMethod" => false,
                    "hasParams" => false
                ];
            $methodName = "";
            $params = [];
            if (isset($pathSplit[0]) && !empty($pathSplit[0])) {
                $controllerName = $pathSplit[0] . "Controller";
                $ensurance['hasController'] = true;
            }else
                return false;

            if (isset($pathSplit[1]) && !empty($pathSplit[1])) {
                $methodName = $pathSplit[1];
                $ensurance['hasMethod'] = true;
            }
            for ($i = 2; $i < count($pathSplit); $i++) {
                if (isset($pathSplit[$i]) && !empty($pathSplit[$i])) {
                    array_push($params, $pathSplit[$i]);
                    $ensurance['hasParams'] = true;
                }else
                    return false;
            }

            //Create the controller and invoke the method!
            if ($ensurance['hasController'] && $ensurance['hasMethod'] && $ensurance['hasParams']) {
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    $controller->{$methodName}($params);
                } else
                    return $this->notFound();

            } elseif ($ensurance['hasController'] && $ensurance['hasMethod']) {
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    $controller->{$methodName}();
                }else{
                    return $this->notFound();
                }

            } elseif ($ensurance['hasController']) {
                if(class_exists($controllerName))
                $controller = new $controllerName();
            }else
                return $this->notFound();

        } else {
            $path .= "Controller";

            if (class_exists($path)) {
                $controller = new $path();

            } else {
                return $this->notFound();
            }
        }
    }

    private function notFound()
    {
        $errorPage = new ErrorController();
        $errorPage->renderPage404();
    }

    public static function noRoute(){
       $page = new ErrorController();
       $page->renderPage404();
}

}