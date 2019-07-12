<?php
namespace Framework;


class Core implements structure {

    function __construct(){


    }

    static function query($sql){
        global $wpdb;
        $dataset = $wpdb->get_results($sql,ARRAY_A);
        return $dataset;
    }


    static function add_taxonomy($name = "", $post_types = Array()){

        $labels = array(
            'name'              =>  ucfirst($name),
            'singular_name'     => ucfirst($name),
            'search_items'      => ucfirst($name).'s',
            'all_items'         => 'All '.ucfirst($name),
            'parent_item'       => 'Parent '.ucfirst($name),
            'parent_item_colon' => 'Parent '.ucfirst($name).':',
            'edit_item'         => 'Edit '.ucfirst($name),
            'update_item'       => 'Update '.ucfirst($name),
            'add_new_item'      => 'Add New '.ucfirst($name),
            'new_item_name'     => 'New '.ucfirst($name).' Name',
            'menu_name'         => ucfirst($name),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => strtolower(sanitize_title($name) )),
        );
        register_taxonomy( strtolower($name), $post_types, $args );

    }

    static function add_post_type($names = Array()){
        if(count($names) > 0) {
            foreach ($names as $name) {

                $labels = array(
                    'name' => ucfirst($name) . 's',
                    'singular_name' => ucfirst($name),
                    'menu_name' => ucfirst($name) . 's',
                    'name_admin_bar' => ucfirst($name),
                    'add_new' => 'Add New ' . ucfirst($name),
                    'add_new_item' => 'Add New ' . ucfirst($name),
                    'new_item' => 'New ' . ucfirst($name),
                    'edit_item' => 'Edit ' . ucfirst($name),
                    'view_item' => 'View ' . ucfirst($name),
                    'all_items' => 'All ' . ucfirst($name) . 's',
                    'search_items' => 'Search ' . ucfirst($name) . 's',
                    'parent_item_colon' => 'Parent ' . ucfirst($name) . 's:',
                    'not_found' => 'No ' . $name . ' found.',
                    'not_found_in_trash' => 'No ' . $name . 's found in Trash.'
                );

                $nameArgs = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'query_var' => true,
                    'rewrite' => array('slug' => strtolower(sanitize_title($name))),
                    'capability_type' => 'post',
                    'has_archive' => true,
                    'hierarchical' => false,
                    'menu_position' => null,
                    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
                );
                register_post_type($name, $nameArgs);
            }
        }
    }

    static function add_sidebar($name){
        $args = array(
            'name'          =>  $name,
            'id'            =>  strtolower(sanitize_title($name)),    // ID should be LOWERCASE  ! ! !
            'description'   => '',
            'class'         => '',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>'
        );
        register_sidebar($args);
    }

    static function add_imageSize($size = Array()){
            list($name,$width,$height,$crop) = $size;
            if($name==""){
                return;
            }
            if($width =="" || $width==0){
                return;
            }
            add_image_size($name , $width, $height,$crop);
    }
}