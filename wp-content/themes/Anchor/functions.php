<?php
/**
 * This is your child theme functions file.  In general, most PHP customizations should be placed within this
 * file.  Sometimes, you may have to overwrite a template file.  However, you should consult the theme 
 * documentation and support forums before making a decision.  In most cases, what you want to accomplish
 * can be done from this file alone.  This isn't a foreign practice introduced by parent/child themes.  This is
 * how WordPress works.  By utilizing the functions.php file, you are both future-proofing your site and using
 * a general best practice for coding.
 *
 * All style/design changes should take place within your style.css file, not this one.
 *
 * The functions file can be your best friend or your worst enemy.  Always double-check your code to make
 * sure that you close everything that you open and that it works before uploading it to a live site.
 *
 * @package SupremeChild
 * @subpackage Functions
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'supreme_child_theme_setup', 11 );
define('T_DOMAIN','anchor');
load_theme_textdomain(T_DOMAIN);
load_textdomain( T_DOMAIN, get_stylesheet_directory().'/languages/en_US.mo');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove 
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since 0.1.0
 */

$theme_name ='';
global $extension_file, $pagenow, $theme_name;

if(is_admin() && ($pagenow =='themes.php' || $pagenow =='post.php' || $pagenow =='edit.php'|| $pagenow =='admin-ajax.php'  || @$_REQUEST['page'] == 'Anchor_tmpl_theme_update')){
	require_once('wp-updates-theme.php');
	if(function_exists('supreme_get_theme_data'))
	$theme_data = supreme_get_theme_data(get_stylesheet_directory().'/style.css');
	new WPUpdatesAnchorUpdater( 'http://templatic.com/updates/api/index.php',basename(get_stylesheet_directory()));
}



function supreme_child_theme_setup() {

	/* Get the theme prefix ("supreme"). */
	$prefix = hybrid_get_prefix();
	define('TEMPLATE_FUNCTION_FOLDER_PATH',get_stylesheet_directory()."/functions/");
	

	/*  Add Action for Customizer Controls Settings Start */
			add_action( 'customize_register',  'anchor_register_customizer_settings');
	/*  Add Action for Customizer Controls Settings End */

	add_theme_support( 'theme-layouts', array( // Add theme layout options.
		'1c',
		'2c-l',
		'2c-r'
	) );

	/* Add framework menus. */
	remove_action( 'init', 'supreme_register_menus' );
	add_theme_support( 'hybrid-core-menus', array( // Add core menus.
		'secondary',
		) );
	register_nav_menu( 'footer', _x( 'Footer', 'nav menu location', 'anchor' ) );
	
	/* Load language file */
	if(file_exists(get_stylesheet_directory()."/language.php")){
		include_once(get_stylesheet_directory()."/language.php");
	}

	/* Load all custom functions from here */
	if(file_exists(get_stylesheet_directory()."/functions/custom_functions.php")){
		include_once(get_stylesheet_directory()."/functions/custom_functions.php");
	}
	
	//Action for adding stylesheet of custom colors
	add_action('wp_head','automotive_colors_settings');
	
	/* Function for adding custom colors file. */
	function automotive_colors_settings(){
		if(file_exists(get_stylesheet_directory()."/css/admin-style.php")){
			include_once(get_stylesheet_directory()."/css/admin-style.php");
		}
	}
	
	/*  Add Action for Customizer Controls Settings Start */
			add_action( 'customize_register',  'anchor_register_customizer_settings');
	/*  Add Action for Customizer Controls Settings End */

	/* Load all widgets from here */
	if(file_exists(get_stylesheet_directory()."/functions/widget_functions.php")){
		include_once(get_stylesheet_directory()."/functions/widget_functions.php");
	}
	
	/* Code for Auto Install */
		if(file_exists(get_stylesheet_directory()."/functions/auto_install/auto_install.php")){
			include_once(get_stylesheet_directory().'/functions/auto_install/auto_install.php');
		}
	/* End Code for Auto Install */
	
	/* Register new image sizes. */
	add_action( 'init', 'anchor_register_image_sizes' );
	
	add_theme_support( 'supreme-slider');
	
	function anchor_register_image_sizes()
	{
    //HioWeb change Oct 13th to use aspect ratio of 41x42
		// add_image_size( 'anchor-listing-thumb', 310, 160, true ); /* Listing Page */
    // add_image_size( 'home-page-slider', 685, 412, true ); /* Slider images */
    // add_image_size( 'post-by-category', 295, 166, true ); /* Post By category Image */
    // add_image_size( 'detail-page-thumb', 612, 280, true ); /* Detail page Image */
    
    //HioWeb change Oct 13th to use aspect ratio of 41x42
    add_image_size( 'anchor-listing-thumb', 290, 297, true ); /* Listing Page */
    add_image_size( 'home-page-slider', 660, 676, true ); /* Slider images */
    add_image_size( 'post-by-category', 290, 297, true ); /* Post By category Image */
    add_image_size( 'detail-page-thumb', 615, 630, true ); /* Detail page Image */
    
	}
	
}

//ADDED CODE FOR FAVICON ICON SETTINGS START.
add_action('admin_head', 'Anchorfavocin_icon');
function Anchorfavocin_icon() {
	$GetSupremeThemeOptions = get_option('supreme_theme_settings');
	$GetFaviconIcon = @$GetSupremeThemeOptions['supreme_favicon_icon'];
	if($GetFaviconIcon!=""){
		echo '<link rel="shortcut icon" href="' . $GetFaviconIcon . '" />';
	}
}
//ADDED CODE FOR FAVICON ICON SETTINGS FINISH.

/* Setting For dismiss auto install notification message from themes.php START */
register_activation_hook( __FILE__, 'activate'  );
register_deactivation_hook( __FILE__, 'deactivate'  );
add_action( 'admin_enqueue_scripts', 'register_admin_scripts'  );
add_action( 'wp_ajax_hide_admin_notification', 'hide_admin_notification' );
function activate() {
	add_option( 'hide_ajax_notification', false );
}
function deactivate() {
	delete_option( 'hide_ajax_notification' );
}
function register_admin_scripts() {
	wp_register_script( 'ajax-notification-admin', get_stylesheet_directory_uri().'/js/admin_notification.js'  );
	wp_enqueue_script( 'ajax-notification-admin' );
}
function hide_admin_notification() {
	if( wp_verify_nonce( $_REQUEST['nonce'], 'ajax-notification-nonce' ) ) {
		if( update_option( 'hide_ajax_notification', true ) ) {
			die( '1' );
		} else {
			die( '0' );
		}
	}
}
/* Setting For dismiss auto install notification message from themes.php END */
?>