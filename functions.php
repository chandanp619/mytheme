<?php
/**
 * mythems functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mythems
 */



require_once(__DIR__.'/framework/core/Autoloader.php');
require_once(__DIR__.'/framework/init.php');

//use framework\Comments;
//use framework\Posts;
//
$p = new \Framework\Core();
//$ss = $p->query("select * from wp_users where 1");
//var_dump($ss);
//
//$p = new Posts(5);
//$p->setID(1);
//
//var_dump($p);


\Framework\Core::add_taxonomy('type',array('post','blog'));
$post_types = array('event','blog','paid tutorial');
\Framework\Core::add_post_type($post_types);
\Framework\Core::add_sidebar("Blog Sidebar");

\Framework\Core::add_imageSize(array('new1',600,130,false));


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

