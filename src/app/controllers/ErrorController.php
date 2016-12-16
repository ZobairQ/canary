<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 21:18
 */

class ErrorController extends Controller
{

    public function __construct()
    {
    }

    public function renderPage404(){
        $this->render("fourofour", []);
    }

}