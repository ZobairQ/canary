<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 22-10-2017
 * Time: 20:09
 */
class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'Name' => Type::string(),
                'Username' => Type::string(),
                'Password' => Type::string(),
                'Email' => Type::string(),
                'Status' => Type::string(),
                'update_at'=>Type::string()
            ]
        ];
        parent::__construct($config);
    }
}