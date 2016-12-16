<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 01:00
 */

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function help($args = false){
        $model =  $this->getModel("UserModel");
        $model->setName("CoolerMaster");
        $model->setUsername("BabyBambolina");
        $model->setPassword("pass");
        $model->save();
        $value= $model->find(1)['Username'];

        $this->render('home', ["value" => $value]);

    }
}