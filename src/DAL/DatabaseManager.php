<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 30-09-2017
 * Time: 19:20
 */

class DatabaseManager{

    /**
     * You have to specify what table you want to query on.
     * @param string $model This is the model
     * @return QueryFactory
     */
    public function from(string $model){
        if (class_exists($model)) {
            // Build query functions that belongs to the model
//            $variables = get_class_var($model);
//
//            if (true) {
//                $index = 0;
//                $wantedMethod = [];
//                foreach ($variables as $variableName) {
//                    $wantedMethod[$index] = "where" . $variableName . "Exist";
//                    $index++;
//                }
//            }

            $instance = new $model();
            return new QueryFactory($model);
        }
        return NULL;
    }
}
