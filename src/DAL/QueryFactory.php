<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 30-09-2017
 * Time: 20:00
 */

class QueryFactory
{
    private $model;
    private $queries = [];
    public function __construct(string $model){
        $this->model = $model;
    }

    public function orWhere(string $columnName, string $operator, $value){
        array_push($this->queries ,
            [
                'function' => 'orWhere',
                'column' => $columnName,
                'operator' => $operator,
                'value' => $value
            ]);
        return $this;
    }

    public function where(string $columnName, string $operator, $value) : QueryFactory {
        if (empty($this->queries)) {
            array_push($this->queries ,
                [
                    'function' => 'where',
                    'column' => $columnName,
                    'operator' => $operator,
                    'value' => $value
                ]);
        }else{
            foreach($this->queries as $query) {
                // if there exist a where already the next one must be an andWhere
                $function = $query['function'];
                if ($function == 'where') {
                    array_push($this->queries,
                        [
                            'function' => "andWhere",
                            'column' => $columnName,
                            'operator' => $operator,
                            'value' => $value
                        ]);
                }
            }
        }
        return $this;
    }

    public function whereIDExists($propertyName): bool {
        $result = $this->model::where($propertyName, '!=', NULL);
        return !empty(array_filter((array)$result));
    }

    public function whereExist($columnName, $columnValue){
        $result = $this->model::where([$columnName => $columnValue]);
        return !empty(array_filter((array)$result));
    }

    public function getOBJ(): Model{
         $ret = $this->queryResults();

        if ($ret->count() == 1) {
            return $ret->first();
        }else {
            throw new TypeError("The query contains several rows, please use get() instead");
        }
    }

    public  function get() : \Illuminate\Database\Eloquent\Collection {
        $arrayToReturn = $this->queryResults();

        if ($arrayToReturn->count() > 1) {
            return $arrayToReturn;
        }else {
            throw new TypeError("No or too less data found ");
        }
}
    /**
     * @return array
     */
    private function queryResults(): \Illuminate\Database\Eloquent\Collection
    {
        foreach ($this->queries as $query) {
            $function = $query['function'];
            $column = $query['column'];
            $operator = $query['operator'];
            $value = $query['value'];

            switch ($function) {
                case "where":
                    $result = $this->model::$function($column, $operator, $value);
                    break;
                case "andWhere":
                    $result = $result->where($column, $operator, $value);
                    break;
                case "orWhere":
                    $result = $result->orWhere($column, $operator, $value);
                    break;
            }
        }
        return $result->get();
    }
}