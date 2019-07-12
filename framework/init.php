<?php
namespace Framework;


class init extends Core
{

    private $textdomain;

    function __construct()
    {
        parent::__construct();
        if ( ! defined( 'ABSPATH' ) ) {
            die("Not Authorized");
        }

        $this->textdomain = 'mytheme';

        add_action('after_setup_theme',array($this,'mytheme_setup'),10,2);
        add_action('wp_enqueue_scripts',array($this,'mytheme_enqueue_styles'),10,2);
        add_action('wp_enqueue_scripts',array($this,'mytheme_enqueue_scripts'),10,2);
        add_action( 'widgets_init', array($this,'mythems_widgets_init'),10,2 );
        do_action('after_mytheme_init');

    }

    /**
     *
     */
    public function mytheme_setup(){
        load_theme_textdomain( $this->textdomain, $this->get_theme_url() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'mythems' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'custom-background', apply_filters( 'mythems_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );


        $GLOBALS['content_width'] = apply_filters( 'mythems_content_width', 640 );

    }

    public function mytheme_enqueue_scripts(){


        wp_enqueue_script( 'mythems-navigation', get_template_directory_uri() . '/resources/scripts/navigation.js', array(), '20151215', true );

        wp_enqueue_script( 'mythems-skip-link-focus-fix', get_template_directory_uri() . '/resources/scripts/skip-link-focus-fix.js', array(), '20151215', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        do_action('before_mytheme_enqueue_scripts');
        wp_enqueue_script("mytheme-script", $this->get_theme_url().'/resources/scripts/mytheme.js',array('jquery'),'1.2');
        do_action('after_mytheme_enqueue_scripts');
    }

    public function mytheme_enqueue_styles(){
        do_action('before_mytheme_enqueue_styles');
        wp_enqueue_style( 'mythems-style', get_stylesheet_uri() );
        wp_enqueue_style("mytheme-style", $this->get_theme_url().'/dest/assets/css/mytheme.css', array(),'1.2','all');
        do_action('after_mytheme_enqueue_styles');
    }

    function get_theme_url(){
        return get_stylesheet_directory_uri();
    }

    function mythems_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'mythems' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'mythems' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }


}

new init();