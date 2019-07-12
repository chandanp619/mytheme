<?php
namespace Framework;

trait Comment {

    public function getComments($postID){
        if($postID){
            $comments = get_comments($postID);
            return $comments;
        }
    }

    public function getComment($commentID){

        $comment = get_comment($commentID, ARRAY_A);
        return $comment;
    }
}