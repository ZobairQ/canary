<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 22-10-2017
 * Time: 20:09
 */

class QueryType extends ObjectType
{
    public function __construct()
    {
        $closure =

        $config = [
            'fields' => [
                'user' => [
                    'type' => new UserType(),
                    'resolve' => function ($root, $args) {
                        $dbManager = new DatabaseManager();
                        return $dbManager->from(UserModelold::class)
                            ->where('id', Operator::EQUAL, "37")
                            ->getOBJ();
                    }
                ],
                'echo' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
            ]
        ];
        parent::__construct($config);
    }
}