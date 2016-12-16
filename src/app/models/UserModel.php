<?php

/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 15-12-2016
 * Time: 22:09
 */

class UserModel extends Model
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
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setAttribute("Name", $name);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
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