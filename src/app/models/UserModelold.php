<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 15-12-2016
 * Time: 22:09
 */

class UserModelold extends Model
{
    //Fields
    private $name;
    private $username;
    private $password;
    protected $table = 'user_infos';
    public $timestamps = false;
    protected $fillable = ['Username', "Password", "Name"];

    public function __construct()
    {
        $attrb = $this->getAttributes();
        if (count($attrb) > 0){
            $this->name = $this->getAttributes()['name'];
            $this->username = $this->getAttributes()['username'];
            $this->password = $this->getAttributes()['password'];
        }
    }
    /**
     * @return string
     */
    public function getName()
    {
        $this->name = $this->getAttribute("Name");
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
        $this->setAttribute("Name", $name);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        $this->username = $this->getAttribute("Username");
        return $this->username;

    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        $this->setAttribute("Username", $username);

    }

    /**
     * @return string
     */
    public function getPassword()
    {
        $this->password = $this->getAttribute("Password");
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        $this->attributes['Password']  = $password;

    }
}