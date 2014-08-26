<?php
/**
 * WP Pinterest (wp-pinterest.php) expanded: admin and client scripts
 *
 * Contains the scripts and the styles needed in wp-pinterest.php
 *
 * @package WordPress
 * @subpackage WP Pinterest
 */

$wp_pinterest_styles = plugins_url('/wp-pinterest-styles.css', __FILE__);
wp_register_style('wp_pinterest_styles', $wp_pinterest_styles, array(), NULL, 'screen');
wp_enqueue_style('wp_pinterest_styles');

?>