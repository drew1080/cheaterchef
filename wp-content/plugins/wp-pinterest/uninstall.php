<?php 
/**
 *	WP Pinterest (wp-pinterest.php) uninstall extended
 *
 *	Deletes all the data from the WordPress database on Plugin deletion
 *
 *	@package WordPress
 *	@subpackage WP Pinterest
 */
    if(!defined('WP_UNINSTALL_PLUGIN') )
        exit ();
	delete_option( 'wp_pinterest_options' );

?>
