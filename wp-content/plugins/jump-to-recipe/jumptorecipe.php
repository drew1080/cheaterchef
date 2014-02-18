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

class JumpToRecipe
{
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_jtr_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_jtr_plugin' ) );
		}
	}
	
	function filter_jtr_button( $buttons ) {
		// add a separation before our button, here our button's id is "mygallery_button"
		array_push( $buttons, '|', 'jumptorecipe_button' );
		return $buttons;
	}
	
	function filter_jtr_plugin( $plugins ) {
		// this plugin file will work the magic of our button
		$plugins['jumptorecipe'] = plugin_dir_url( __FILE__ ) . '/js/jumptorecipe_plugin.js';
		return $plugins;
	}
}

$jumptorecipe = new JumpToRecipe();

function register_jump_scripts() {
	wp_enqueue_script(
		'custom-script',
		plugin_dir_url( __FILE__ ) .'/js/jump-to-plugin-page-load.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'register_jump_scripts' );
