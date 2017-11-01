<?php
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 01:00
 */

class HomeController extends Controller
{
    public function testService(){
        $schema = new Schema([
            'query' => new QueryType(),
        ]);

        $this->startGraphQLService($schema, null,'query');
    }

    public function testTheDatabase(){
        $arr = $this->getDbManager()->from(UserModelold::class)
            ->where('id', Operator::EQUAL, '5')
            ->getOBJ();

    }

    public function home($args = false){
        if ($args) {
            $id = $args[0];
            $user = $this->getDbManager()->from(UserModelold::class)
                ->where('id', Operator::EQUAL, $id)
                ->getOBJ();
           echo  $user->Password;
        }

        $listOfObj = $this->getDbManager()->from(UserModelold::class)
            ->orderBy('Name', Operator::DESC)
            ->getList();

        foreach ($listOfObj as $obj){
            echo $obj->getName(). " <br/>";
        }
    }

    final function createData(){
        $user = new UserModel();
        $user->setUsername('zobair');
        $user->setPassword('password');
        $post = new PostModel();
        $post->setContent("Hello World");
        $post->setTitle("The beginning");
        echo "everything seem nice";
        $user->save();
        $post->getUsers()->associate($user);
        $post->save();

    }

    public function help($args = false){

        try {
            $asdf = $this->getDbManager()
                ->from(UserModelold::class)
                ->where('name', Operator::EQUAL, 'zobair')
                ->where('username', Operator::EQUAL, 'bambolina')
                ->where('password', Operator::EQUAL, 'pass')
                ->getOBJ();
            $this->render('home', ['value' => $asdf]);
        } catch (TypeError $e) {
            echo $e->getMessage();
        }

        #$model->get
        # echo $model->getName();
        # var_dump($model);


//        $model =  $this->getModel("UserModelold");
        /*$model = new UserModelold();
*/
        #$value = UserModelold::where(['Username', '=', 'bambolina'])->get(array('Name'));

//        $model = UserModelold::create(
//            array(
//                'Name' => "Massir",
//                'Username' => 'Samaroq',
//                'Password' => 'passo'
//            ));


        // Query for messages that has receiver id
//        $this->getDbManager()->from(UserModelold::class)->where('id', Operator::EQUAL, "value");
//        $privateMessages = $this->dbManager->from(MessageModel::class)->whereExists(receiver_id);
//        $privateMessages = $this->dbManager->from(MessageModel::class)->whereReciverIdExists();
//        // Query for products that costs more than $1000
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->where(price, GreaterThan, 1000);
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->wherePriceGreatThan(1000);
//        $expensiveProducts = $this->dbManager->from(ProductModel::class)->wherePrice(operator, 1000);
//        // Query for persons with an education
//        $educatedPersons = $this->dbManager->from(UserModelold::class)->whereEducationExist(operator, value);
//        $educatedPersons = $this->dbManager->from(UserModelold::class)->whereExist(education);
//        // Query if a person id is existing in the database
//        $personExists = $this->dbManager->from(UserModelold::class)->whereExist(person_id);
//        $personExists = $this->dbManager->from(UserModelold::class)->wherePersonIdExist();

        /*$this->dbManager->forModel(UserModelold::class)->join(MessageModel::class)->where();

        $this->dbManager->getObj(UserModelold::class)->where($condition);
        $this->dbManager->get(UserModelold::class)->where($condition);

        $this->dbManager->doesExist(UserModelold::class, $id)*/
        //SELECT * FROM messages WHERE receiver_id NOT NULL
        //php

//        $usernameExists = $this->dbManager->from(MessageModel::class)->whereExist($username)->orExist($email);// implementation


//        if (!$usernameExists) {
//            $message = "Sorry buddy you are already registered";
//            return $this->render('message', ['message' => $message]);
//        }
//


        #####################################################################
//        $result = UserModelold::where(['username' => $username])
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


//        $statics = UserModelold::all(['username', 'password']);
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