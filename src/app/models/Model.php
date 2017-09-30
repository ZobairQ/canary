<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 16-12-2016
 * Time: 01:38
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    public function getSomething(): Model{
        return $this;
    }


}