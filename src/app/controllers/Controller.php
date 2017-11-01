<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 01:00
 */

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
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

    protected function startGraphQLService(Schema $schema, $rootValue,String $rootNode){
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input[$rootNode];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;

        try {
            //$rootValue = ['prefix' => 'You said: ']; //TODO:Fix this to something more meaninful
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($output);
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
