<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 01:00
 */

use League\Plates\Engine as Engine;

abstract class Controller{

    private $template;
    private $dbManager;

    /**
     * The method searches and renders a view
     * @param $templateName string
     * @param array $params array
     */
    protected function render($templateName, $params = []){
        $this->instantiate();
        echo $this->template->render($templateName, $params);
    }

    /**
     * The method take the model name and returns an instance of the model.
     * if the model does not exist, it returns NULL
     * @param  $model string
     * @return Object of Model or null
     */
    protected function getModel($model){
        if(!class_exists($model)) {
            return null;
        }
        else {
            return new $model();
        }
    }

    /**
     *
     * Checks if Engine is initialized and instantiates it
     */
    private function instantiate(){
        if($this->template == null)
            $this->template = new Engine($GLOBALS['config']['Path']["Templates"]);
    }

    protected function getDbManager(): DatabaseManager{

        if ($this->dbManager == null) {
            $this->dbManager = new DatabaseManager();
        }

        return $this->dbManager;
    }
}
