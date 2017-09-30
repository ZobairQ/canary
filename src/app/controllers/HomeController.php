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

    final function createData(){
        $model = new UserModel();
        $model->setName("Sahab");
        $model->setPassword("mypassword");
        $model->setUsername("Sexyboy28");
        $model->save();
    }

    public function help($args = false){

        try {
            $asdf = $this->getDbManager()
                ->from(UserModel::class)
                ->where('name', Operator::EQUAL, 'zobair')
                ->where('username', Operator::EQUAL, 'bambolina')
                ->where('password', Operator::EQUAL, 'pass')
                ->orWhere()
                ->getOBJ();
            $this->render('home', ['value' => $asdf]);
        } catch (TypeError $e) {
            echo $e->getMessage();
        }

        #$model->get
        # echo $model->getName();
        # var_dump($model);


//        $model =  $this->getModel("UserModel");
        /*$model = new UserModel();
*/
        #$value = UserModel::where(['Username', '=', 'bambolina'])->get(array('Name'));

//        $model = UserModel::create(
//            array(
//                'Name' => "Massir",
//                'Username' => 'Samaroq',
//                'Password' => 'passo'
//            ));


        // Query for messages that has receiver id
//        $this->getDbManager()->from(UserModel::class)->where('id', Operator::EQUAL, "value");
//        $privateMessages = $this->dbManager->from(MessageModel::class)->whereExists(receiver_id);
//        $privateMessages = $this->dbManager->from(MessageModel::class)->whereReciverIdExists();
//        // Query for products that costs more than $1000
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->where(price, GreaterThan, 1000);
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->wherePriceGreatThan(1000);
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->wherePrice(operator, 1000);
//        // Query for persons with an education
//        $educatedPersons = $this->dbManager->from(UserModel::class)->whereEducationExist(operator, value);
//        $educatedPersons = $this->dbManager->from(UserModel::class)->whereExist(education);
//        // Query if a person id is existing in the database
//        $personExists = $this->dbManager->from(UserModel::class)->whereExist(person_id);
//        $personExists = $this->dbManager->from(UserModel::class)->wherePersonIdExist();

        /*$this->dbManager->forModel(UserModel::class)->join(MessageModel::class)->where();

        $this->dbManager->getObj(UserModel::class)->where($condition);
        $this->dbManager->get(UserModel::class)->where($condition);

        $this->dbManager->doesExist(UserModel::class, $id)*/
        //SELECT * FROM messages WHERE receiver_id NOT NULL
        //php

//        $usernameExists = $this->dbManager->from(MessageModel::class)->whereExist($username)->orExist($email);// implementation


//        if (!$usernameExists) {
//            $message = "Sorry buddy you are already registered";
//            return $this->render('message', ['message' => $message]);
//        }
//


        #####################################################################
//        $result = UserModel::where(['username' => $username])
//            ->orWhere(['email' => $email])->get();
//
//        if (!empty(array_filter((array)$result))) {
//            $message = "Sorry buddy you are already registered";
//            $this->render('message', ['message' => $message]);
//            return false;
//        }



        //SELECT * FROM products WHERE price/total > 1000;
        //WHERE education NOT NULL;
        //WHERE ID = x;
//        $this->dbManager->Select(*)->from(MessageModel::class)->where()->
        //
            //(table1)->join(table2)
        //where (....)


//        $statics = UserModel::all(['username', 'password']);
//        $oneEntry = $statics[0];
//        foreach ($statics as $model) {
            /*echo $model->getUsername();
            echo $model->getPassword();
            echo $model->getName();*/
           # echo "<p>" . "The username of an entry:" . $oneEntry->getUsername() . "</p>";
//        }


//       var_dump($statics);
//        $value = $model;
        #$this->render('home', ["value" => $value]);
    }
}