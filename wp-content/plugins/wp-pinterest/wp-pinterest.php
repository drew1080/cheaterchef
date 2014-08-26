<?php
	
/*
Plugin Name: WP Pinterest
Plugin URI: http://techably.com/wp-pinterest-wordpress-plugin/7225/
Description: WP Pinterest provides easy Pinterest integration with your WordPress site. Add Pin-it button, Pinterest Follow button and Pinterest Pinboards to WordPress without hassle.
Version: 1.0
Author: Rahul Arora
Author URI: http://techably.com/about/
License: GPLv2
*/

/**	
 *	Copyright 2012 TechAbly.com (email: rahul@techably.com)
 *	
 *	This program is a free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, or (at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 */
 
/**
 *	WP Pinterest (wp-pinterest.php)
 *
 *	Main Plugin File
 *
 *	@package WordPress
 *	@subpackage WP Pinterest
 */
  
	require_once('includes/admin-options.php');
	require_once('includes/scripts.php');
	require_once('includes/functions.php');
	
	add_action('widgets_init', 'wp_pinterest_register_widgets');
	function wp_pinterest_register_widgets() {
		register_widget('wp_pinterest_pinboard');
	}
	
	class wp_pinterest_pinboard extends WP_Widget {
		function wp_pinterest_pinboard() {
			$widget_ops = array(
				'classname' => 'wp_pinterest_pinboard',
				'description' => 'Displays a list of Pinterest Pins.'
				);
			$this->WP_Widget('wp_pinterest_pinboard', 'WP Pinterest Pinboard Widget', $widget_ops);
			
		}
		
		function form($instance) {
			$defaults = array(
				'title'			=>	'Recent Pins',
				'username'		=>	'',
				'pinboard'		=>	'',
				'pins'			=> '15',
				'pinwidth'		=> '',
				'pinheight'		=> '',
				'maxheight'		=> '',
				'print_title'	=> '',
				'pinterest_link'=> 'icon-text-red',
				'columns'		=> '1'
				);
			$instance = wp_parse_args((array)$instance, $defaults);
			$title = $instance['title'];
			$username = $instance['username'];
			$pinboard = $instance['pinboard'];
			$pins = $instance['pins'];
			$pinwidth = $instance['pinwidth'];
			$pinheight = $instance['pinheight'];
			$maxheight = $instance['maxheight'];
			$print_title = $instance['print_title'];
			$pinterest_link = $instance['pinterest_link'];
			$columns = $instance['columns'];
			?>
				<p><label for="<?php echo $this->get_field_name('title'); ?>">Title</label> <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
				<p><label for="<?php echo $this->get_field_name('username'); ?>">Pinterest Username</label> <input class="widefat" name="<?php echo $this->get_field_name('username'); ?>" id="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
				<p><label for="<?php echo $this->get_field_name('pinboard'); ?>">Pinboard Name</label><input class="widefat" name="<?php echo $this->get_field_name('pinboard'); ?>" id="<?php echo $this->get_field_name('pinboard'); ?>" type="text" value="<?php echo esc_attr($pinboard); ?>" /></p>
				<p><label for="<?php echo $this->get_field_name('pins'); ?>">Number of Pins to display</label> 
					<select name="<?php echo $this->get_field_name('pins'); ?>" id="<?php echo $this->get_field_name('pins'); ?>">
						<option value="10" <?php selected($pins, 10); ?>>10</option>
						<option value="15" <?php selected($pins, 15); ?>>15</option>
						<option value="20" <?php selected($pins, 20); ?>>20</option>
						<option value="25" <?php selected($pins, 25); ?>>25</option>
						<option value="30" <?php selected($pins, 30); ?>>30</option>
						<option value="40" <?php selected($pins, 40); ?>>40</option>
						<option value="50" <?php selected($pins, 50); ?>>50</option>
					</select>
				</p>
				<p><label for="<?php echo $this->get_field_name('pinwidth'); ?>">Pin width</label> <input class="widefat" name="<?php echo $this->get_field_name('pinwidth'); ?>" id="<?php echo $this->get_field_name('pinwidth'); ?>" type="text" value="<?php echo esc_attr($pinwidth); ?>" /></p>
				<p><label for="<?php echo $this->get_field_name('pinheight'); ?>">Pin height</label> <input class="widefat" name="<?php echo $this->get_field_name('pinheight'); ?>" id="<?php echo $this->get_field_name('pinheight'); ?>" type="text" value="<?php echo esc_attr($pinheight); ?>" /></p>
				<p><label for="<?php echo $this->get_field_name('maxheight'); ?>">Maximum Height of Pin</label> <input class="widefat" name="<?php echo $this->get_field_name('maxheight'); ?>" id="<?php echo $this->get_field_name('maxheight'); ?>" type="text" value="<?php echo esc_attr($maxheight); ?>" /></p>
				<p><label for="<?php echo $this->get_field_id('print_title'); ?>">Show Pin description</label> <input class="checkbox" name="<?php echo $this->get_field_name('print_title'); ?>" id="<?php echo $this->get_field_id('print_title'); ?>" type="checkbox" <?php checked($instance['print_title'], true); ?> /></p>
				<p><label for="<?php echo $this->get_field_name('columns'); ?>">Columns</label> 
				<select name="<?php echo $this->get_field_name('columns'); ?>" id="<?php echo $this->get_field_name('columns'); ?>">
						<option value="1" <?php selected($columns, 1); ?>>1</option>
						<option value="2" <?php selected($columns, 2); ?>>2</option>
						<option value="3" <?php selected($columns, 3); ?>>3</option>
						<option value="4" <?php selected($columns, 4); ?>>4</option>
						<option value="5" <?php selected($columns, 5); ?>>5</option>
					</select>
				</p>
				<p><label for="<?php echo $this->get_field_name('pinterest_link'); ?>">Pinterest button</label> 
					<select name="<?php echo $this->get_field_name('pinterest_link'); ?>" id="<?php echo $this->get_field_name('pinterest_link'); ?>">
						<optgroup label="White button">
						<option value="large-white" <?php selected($pinterest_link, 'large-white'); ?>>Large</option>
						<option value="medium-white" <?php selected($pinterest_link, 'small'); ?>>Medium</option>
						<option value="icon-white" <?php selected($pinterest_link, 'icon-white'); ?>>Icon</option>
						<option value="tiny-white" <?php selected($pinterest_link, 'tiny-white'); ?>>Tiny</option>
						<option value="icon-text-red" <?php selected($pinterest_link, 'icon-text-white'); ?>>Icon with Text</option>
						</optgroup>
						<optgroup label="Red button">
						<option value="large-red" <?php selected($pinterest_link, 'large-red'); ?>>Large</option>
						<option value="medium-red" <?php selected($pinterest_link, 'medium-red'); ?>>Medium</option>
						<option value="icon-red" <?php selected($pinterest_link, 'icon-text-red'); ?>>Icon</option>
						<option value="tiny-red" <?php selected($pinterest_link, 'tiny-red'); ?>>Tiny</option>
						<option value="icon-text-red" <?php selected($pinterest_link, 'icon-text-red'); ?>>Icon with Text</option>
						</optgroup>
						<option value="none" <?php selected($pinterest_link, 'none'); ?>>None</option>
					</select>
				</p>
			<?php
		}
		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['username'] = strip_tags($new_instance['username']);
			$instance['pinboard'] = strip_tags($new_instance['pinboard']);
			$instance['pins'] = strip_tags($new_instance['pins']);
			$instance['pinwidth'] = strip_tags($new_instance['pinwidth']);
			$instance['pinheight'] = strip_tags($new_instance['pinheight']);
			$instance['maxheight'] = strip_tags($new_instance['maxheight']);
			$instance['print_title'] = ( isset( $new_instance['print_title'] ) ? 1 : 0 );  
			$instance['pinterest_link'] = strip_tags($new_instance['pinterest_link']);
			$instance['columns'] = strip_tags($new_instance['columns']);
	
			return $instance;
		}
		
		function widget($args, $instance) {
			extract($args);
			
			echo $before_widget;
			$title = apply_filters('widget_title', $instance['title']);
			$username = empty($instance['username']) ? '' : $instance['username'];
			$pinboard = empty($instance['pinboard']) ? '' : $instance['pinboard'];
			$pins = empty($instance['pins']) ? '15' : $instance['pins'];
			$pinwidth = empty($instance['pinwidth']) ? '120' : $instance['pinwidth'];
			$pinheight = empty($instance['pinheight']) ? '' : $instance['pinheight'];
			$maxheight = empty($instance['maxheight']) ? '' : $instance['maxheight'];
			$print_title = empty($instance['print_title']) ? '0' : $instance['print_title'];
			$pinterest_link = empty($instance['pinterest_link']) ? 'icon-text-white' : $instance['pinterest_link'];
			$columns = empty($instance['columns']) ? '1' : $instance['columns'];
			
			if( !empty($title) ) {
				echo $before_title . $title . $after_title;
			}
			echo wp_pinterest_pinboard($username, $pinboard, $pins, $pinwidth, $pinheight, $maxheight, $print_title, $pinterest_link, $columns);
			echo $after_widget;
		}
	}
	
?>