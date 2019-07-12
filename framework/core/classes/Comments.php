<?php
namespace Framework;

use \Framework\Comment;

class Comments
{
    private $comments="";

    public function __construct($postID=0) {
        if($postID > 0){
            $this->comments = get_comments($postID);
        }
    }
}