<?php
namespace Framework;


class Posts
{
    use \Framework\Post;

    public function __construct($id){
        if($id >0){
            $this->setID($id);
        }
    }

    public function set_ID($id){

    }
}