# Canary #

Canary project is a super light MVC PHP framework.

- [Canary](#canary)
  - [Get Started](#get-started)
  - [Configuration](#configuration)
  - [The Project Structure](#the-project-structure)
  - [Controllers](#controllers)
    - [Example - Inheritance](#example---inheritance)
    - [Example - Render](#example---render)
  - [Views](#views)
    - [Example](#example)
  - [Models](#models)
    - [What is Model](#what-is-model)
    - [Inherit from Model](#inherit-from-model)
    - [Change Table](#change-table)
    - [Add the fillables](#add-the-fillables)
  - [GraphQL Support](#graphql-support)
    - [Types](#types)
      - [User](#user)

## Get Started ##

In order to get started, go ahead and clone the repository with following command

``` git

git clone https://github.com/ZobairQ/canary.git
```

## Configuration ##

Once you have a copy of the Canary projects, you're almost ready to get started with your first application.
Before you start building your application, please go ahead and configure the settings inside the ```config.php``` file.

Enter you application name, version and domain like so

``` php

<?php
$config = [
      "AppName" => "AwesomeApplication",
       "Version" => "0.0.1",
       "Domain" => "www.CanaryIsAwesome.com",

       //..
       ]
?>
```

The next thing you need to change inside the ```config.php``` file is settings for your database.

```php

<?php
$config =
    [
       //..
"Databases" => [
            "MainDatabase" =>
                [
                    "DatabaseType" => "mysql",
                    "Host" => "127.0.0.1",
                    "DatabaseName" => "my_database",
                    "Username" => "root",
                    "Password" => ""
                ],
        //..

    ]

?>
```

When you have configured you settings inside ```config.php``` file you are ready to start your application.

## The Project Structure ##

In this section we will take a look at the overall project structure.
The root of the project is Canary folder.

```Canary```

Inside the root folder we have two folders ```Canary/lib/``` and ```Canary/src/```

The ```lib/``` folder is for external libraries that needs to be used in the project.
The ```src/``` folder is where your future webapplication is going to live inside.

You can find several files inside the  ```src/``` folder and you can basically ignore them once you have configured your ```config.php``` file.

Inside the ```Canary/src/``` folder, you can find the ```app/``` folder. This is the folder where all of your code should be inside.

Inside the ```Canary/src/app``` folder, you can find 3 additional subfolders.

* The controllers folder ``` Canary/src/app/Controllers```
* The models folder ``` Canary/src/app/models/```
* The views folder ``` Canary/src/app/views/```

## Controllers ##

This page demonstrates the usage of the controllers as well as the naming convention that must be applied.

The ```controllers/``` folder contains all of the controllers that are being used throughout the web application. By default a single file should be found. The file named ```Controller.php``` is the base controller that every other controller should inherit from.

Get started in the following steps

1. Create a new php file inside the controllers folder.(Remember to name the file with the postfix of Controller)
2. Inside your php file create a class and inherit from the ```controller```
3. write your controller logic.

### Example - Inheritance ###

It is very important that your class has a postfix of controller.
In the following example we have a ```Home``` controller that is called ```HomeController```

```php

<?php
class HomeController extends Controller
{
    public function __construct(){}
}

?>
```

### Example - Render ###

Once you have a controller with logic implemented, you will need to invoke the method

```php
<?php render($template:string, $values:array) ?>
```

The render method takes a template as first parameter and a an array of values that should be passed to the view.

Consider the following ```about()``` method.
The method invokes `render` with the parameters of `home`. `home.php`is a file inside the views folder. The render method can now find and display the view that is found inside `home.php` file

For further detail about this subject please read [How to use views](#views)

```php

<?php

class HomeController extends Controller
{
    public function __construct(){}

    public function about(){
      $this->render('home', ["name" => "Alex"]);
    }
}

?>
```

## Views ##

This page demonstrates how to access and create views.
The view component uses Plates rendering engine to render the view.
In order to  create a new view, you have create a `php`file inside the `views/`folders.

When you have created the file, you just then inherit from the base view

The inheritance is done by include a single line of `PHP` code at the top of the view.

### Example ###

Let's assume that we have created a new file inside the `views/`folder , now we must inherit from base view. We want the title of our current page to be `Welcome`

```php
<?php
$this->layout('base', ["title"=>"Welcome"]);
?>

<p> Here goes the content of the page</p>
```

## Models ##

This section demonstrates how to use models.

### What is Model ###

The model, as the name suggests, is basically representation of your data.
The model uses the eloquent ORM to retrieve and hold data from your database

### Inherit from Model ###

In canary every model inherits from Model class.

```php
<?php
class UserModel extends Model
{
}

?>
```

### Change Table ###

if the name of your table in the database is different from the name of the model you can change it by overriding the default "table" property inside the model.
In this case our table is called 'users' whereas our model is UserModel

```php
<?php
class UserModel extends Model
{  
    //Fields
    protected $table = 'users';
}

?>
```

### Add the fillables ###

You have to specify what fields should be filled in the database, you do that by overriding the fillable property of Model.

``` php
<?php
class UserModel extends Model
{  
    //Fields
    protected $table = 'users';
    protected $fillable = ['id','username', "password", "posts_id"];

}

?>
```

For more information on this subject checkout Eloquent documentation.

And here is an example with relations

```php
<?php
class UserModel extends Model
{
    //Fields
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['id','username', "password", "posts_id"];

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
    }

    public function getPassword(){
        $this->getAttribute('password');
    }


    public function getUsername(){
        $this->getAttribute('username');
    }

    public function getPosts(){
        return $this->hasMany(PostModel::class, 'user_id');
    }

    public function setUsername($username)
    {        $this->setAttribute('username', $username);

    }

    public  function setPassword($password){
        $this->setAttribute('password', $password);
    }
}

?>
```

## GraphQL Support ##

With the new update Canary now supports GraphQL.
You can now use Canary to create GraphQL endpoint effortlessly.
In order to start the endpoint you have to invoke 'startGraphQLService' inside a specified Controller

The method needs a Schema, rootValue(null), and given rootNode

```php
<?php
class HomeController extends Controller
{
    public function testService(){
        $schema = new Schema([
            'query' => new QueryType(),
        ]);

        $this->startGraphQLService($schema, null,'query');
    }
}

?>
```

### Types ###

The Schema needs something to show, in our case it's the queryType
It needs fields,
args are optional
and it needs resolver function, this is where you tell it how to retrieve the data

```php

<?php
class QueryType extends \GraphQL\Type\Definition\ObjectType
{
    public function __construct()
    {
        $closure = function ($root, $args) {
            $dbManager = new DatabaseManager();
            return $dbManager->from(UserModelold::class)
                ->where('id', Operator::EQUAL, $args['id'])
                ->getOBJ();
        };

        $config = [
            'fields' => [
                'user' => [
                    'type' => new UserType(),
                    'args' => [
                        'id' => Type::int(),
                    ],
                    'resolve' => $closure
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

?>
```

#### User ####

The type of the user field inside the QueryType is UserType and the naming of the userType fields should be the same as the one you find in your database.
![tables.jpg](https://bitbucket.org/repo/RdbzBG/images/765242313-tables.jpg)

```php
<?php

class UserType extends \GraphQL\Type\Definition\ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'Name' => Type::string(),
                'Username' =>  Type::string(),
                'Password' => Type::string(),
            ]
        ];
        parent::__construct($config);
    }
}

?>
```

What you see above is a shorthand notation for this:

```php
<?php

class UserType extends \GraphQL\Type\Definition\ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'Name' => [
                    'type' => Type::string()
                ],
                'Username' => [
                    'type' => Type::string()
                ],
                'Password' => [
                    'type' => Type::string()
                ],
            ]
        ];
        parent::__construct($config);
    }
}
?>
```
