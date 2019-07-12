<?php
namespace Framework;

trait Post {

    public function setID($id){
        if($id > 0){
            $this->init($id);
        }
    }

    public function getID(){
        return $this->ID;
    }

    public function get_meta($meta_name=""){
        $meta = get_post_meta($this->ID,$meta_name,true);
        return $meta;
    }

    public function init($id){
        $data = get_post($id);
        foreach($data as $k=>$v){
            $this->{$k} = $v;
        }
    }

}