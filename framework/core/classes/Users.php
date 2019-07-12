<?php
namespace Framework;
use \Framework\User;

class Users
{

    public function __construct($uid){
        $this->data = get_userdata($uid);
    }

}