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
//             Build query functions that belongs to the model
//            this is not even possible
//            $ref = new ReflectionClass($model);
//            $properties = $ref->getProperties();
//            var_dump($properties);
//
//            if ($properties) {
//                $index = 0;
//                $wantedMethod = [];
//                foreach ($properties as $property) {
//                    if ($this->isTargetProperty($model, $property, $ref)) {
//                        $wantedMethod[$index] = "where" . ucfirst($property->getName()) . "Exist";
//                    }
//                    $index++;
//                }
//            }

            $instance = new $model();
            return new QueryFactory($model);
        }
        return NULL;
    }

    /**
     * @deprecated
     * @param string $model
     * @param $property
     * @return bool
     */
    private function isTargetProperty(string $model, $property, $ref): bool
    {
        $firstCondition =  $property->class == $model;
        $secondCondition = false;
        $methods = $ref->getMethods();
        if ($firstCondition) {
            foreach ($methods as $method) {
                if ($method->class == $model) {
                    if (strtolower($method->name) == 'get' . $property->name) {
                        return true;
                    }
                }
            }
        }else{
            $firstCondition = false;
        }
        return $firstCondition && $secondCondition;
    }
}
