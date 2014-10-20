<?php
/*
Plugin Name: Jump To Recipe
Plugin URI: http://wonderingcobb.com
Description: Jump to the recipe portion of a page.
Version: 0.1
Author: Andrew Cobb
Author URI: http://wonderingcobb.com
*/

if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );


function register_jump_scripts() {
  wp_enqueue_script(
    'custom-script',
    plugin_dir_url( __FILE__ ) .'js/jump-to-plugin-page-load.js',
    array( 'jquery' )
  );
}

add_action( 'wp_enqueue_scripts', 'register_jump_scripts' );


// Hooks your functions into the correct filters
function my_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'my_register_mce_button' );
	}
}
add_action('admin_head', 'my_add_mce_button');

// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/jumptorecipe_plugin.js';
	return $plugin_array;
}

// Register new button in the editor
function my_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	return $buttons;
}
