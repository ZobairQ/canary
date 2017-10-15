<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-10-2017
 * Time: 21:55
 */

class PostModel extends Model{

    protected $fillable = ["content", "title",'users_id'];
    protected $table = 'posts';
    public $timestamps = false;
    private $content;
    private $title;

    /**
     * PostModel constructor.
     * @param $content
     * @param $title
     */
    public function __construct()
    {
    }

    /**
     * @param array $content
     */
    public function setContent( $content)
    {
        $this->content = $content;
        $this->setAttribute('content', $content);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->setAttribute('title', $title);
        $this->title = $title;

    }
    public function getUsers(){
        return $this->belongsTo(UserModel::class, 'users_id');
    }
    /**
     * @return array
     */
    public function getContent()
    {
        return $this->getAttribute('content');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getAttribute('title');
    }

}