<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-10-2017
 * Time: 22:00
 */

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