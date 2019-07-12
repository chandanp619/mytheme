<?php


namespace Framework;


class Themes
{
    use Theme;

    function __construct(){

        add_action('init',array($this,'addThemeSettingsMenu'),10,2);
        add_action( 'admin_init', array( $this, 'setupSections' ) );
    }

    function addThemeSettingsMenu(){
        $page_title = 'MyTheme Settings';
        $menu_title = 'MyTheme Settings';
        $capability = 'manage_options';
        $slug = 'mytheme-settings';
        $callback = array( $this, 'viewSettings' );
        $icon = 'dashicons-admin-plugins';
        $position = 100;

        add_options_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    function viewSettings(){
        require_once(__DIR__.'/../views/admin/dashboard.php');
    }

    function setupSections(){
        add_settings_section( 'general-settings', 'General Settings', array( $this, 'general_settings_callback' ), 'mytheme-settings' );
        add_settings_section( 'layout-selection', 'Layout Settings', array( $this, 'layouts_callback' ), 'mytheme-settings' );

    }


    function general_settings_callback(){
        add_settings_field( 'our_first_field', 'Site Title', array( $this, 'general_settings_fields_callback' ), 'mytheme-settings', 'general-settings' );
    }

    function layouts_callback(){
       add_settings_field( 'select-layout', 'Select Layout', array( $this, 'layouts_settings_fields_callback' ), 'mytheme-settings', 'layout-selection' );

    }


    function general_settings_fields_callback(){
        echo '<input name="site-title" id="Site Title" type="text" value="' . get_option( 'site-title' ) . '" />';
        register_setting( 'general-settings', 'site-title' );
    }

    function layouts_settings_fields_callback(){
        echo $selected = get_option( 'select-layout' );
        echo '<select name="select-layout" id="select-layout"><option value="">Select</option>';echo '<option value="full-width" ';if($selected == "full-width"){ echo "selected";}echo '>Full Width</option>';echo '<option class="column-right" ';if($selected == "column-right"){ echo "selected";}echo '>Right Column</option>';echo '<option class="column-left"'; if($selected == "column-left"){ echo "selected";} echo '>Left Column</option>';
        echo '</select>';
        register_setting( 'layout-selection', 'select-layout' );
    }



}
new Themes();