<?php
/**
 *	WP Pinterest (wp-pinterest.php) functions expanded
 *
 *	Functions needed in wp-pinterest.php
 *
 *	@package WordPress
 *	@subpackage Pinterest for WP Pinterest
 */
 
	/** 
	 *	wp_pinterest_pin_it_button(...);
	 *	Renders Pin-it button
	 */
	 
 
	function wp_pinterest_pin_it_button($pin_it_button_layout) { 
	
		wp_register_script('pinit', 'https://assets.pinterest.com/js/pinit.js', array(), null, true);
		wp_enqueue_script('pinit');
		$pin_permalink = get_permalink();
		$pin_title = get_the_title();
		
		$default_pin_img = $options['wp_pinterest_default_pin_img'];
		$attachment_post_thumbnail = '';
		
		if(function_exists('the_post_thumbnail'))
			$attachment_post_thumbnail = wp_get_attachment_url(get_post_thumbnail_id());
		
		global $wp_query;
		$wp_pinterest_post_id = $wp_query->post->ID;
		$custom_pin_img = get_post_meta($wp_pinterest_post_id, 'pin', true);
		wp_reset_query();
		
		if($custom_pin_img) 
			$pin_img = $custom_pin_img;
		else {
			if($attachment_post_thumbnail)
				$pin_img = $attachment_post_thumbnail;
			else 
				$pin_img = $default_pin_img;
		}
		
		$pin_it_button = '<a href="http://pinterest.com/pin/create/button/?url=' . $pin_permalink . '&media=' . $pin_img. '&description=' . $pin_title . '" class="pin-it-button" count-layout="' . $pin_it_button_layout . '">Pin It</a>';
		
	
		wp_pinterest('Pin-it button');
		
		return $pin_it_button;
		
	}
	
	add_filter('the_content', 'wp_pinterest_pin_it_button_control');
	
	/**
	 *	wp_pinterest_follow_button(...);
	 *	Renders Pinterest Follow button
	 */
	function wp_pinterest_follow_button($pinterest_username, $pinterest_follow_button_layout) {
	
		$options = get_option('wp_pinterest_options');
		
		if($pinterest_follow_button_layout == 'large-white') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png';
		else if($pinterest_follow_button_layout == 'medium-white') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/about/buttons/pinterest-button.png';
		else if($pinterest_follow_button_layout == 'icon-white') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/about/buttons/big-p-button.png';
		else if($pinterest_follow_button_layout == 'tiny-white') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/about/buttons/small-p-button.png';
		else if($pinterest_follow_button_layout == 'large-red') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/follow-on-pinterest-button.png';
		else if($pinterest_follow_button_layout == 'medium-red') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/pinterest-button.png';
		else if($pinterest_follow_button_layout == 'icon-red') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/big-p-button.png';
		else if($pinterest_follow_button_layout == 'tiny-red') $pinterest_follow_button_img = 'http://passets-cdn.pinterest.com/images/small-p-button.png';
		else $pinterest_follow_button_img = '';
		
		if($pinterest_follow_button_img)
			$pinterest_follow_button = '<a href="http://pinterest.com/' . $pinterest_username . '/"><img src="' . $pinterest_follow_button_img . '" alt="Follow Me on Pinterest" /></a>';
		else $pinterest_follow_button = '';
	
		wp_pinterest('Pinterest Follow Button');
		
		return $pinterest_follow_button;
	}
	
	/**
	 *	wp_pinterest_pinboard(...);
	 *	Renders a Pinterest Pinboard (Recent Pins)
	 */
	function wp_pinterest_pinboard($username, $pinboard, $pins, $pinwidth, $pinheight, $pinmaxheight, $print_title, $pinterest_link, $columns) {

		include_once(ABSPATH . WPINC . '/feed.php');
		$content = '';
		$pinboard = strtolower($pinboard);
		$pinboard = str_replace('\'', ' ', $pinboard);
		$pinboard = str_replace('\"', ' ', $pinboard);
		$pinboardslug = preg_replace("/&#?[a-z0-9]+;/i", "" ,$pinboard);
		$pinboardslug = preg_replace("/[^a-zA-Z0-9\s]/", "" ,$pinboardslug);
		$pinboardslug = preg_replace("/[ ]+/", " ", $pinboardslug);
		$pinboardslug = preg_replace("/ /", "-", $pinboardslug);
		if(empty($pinboard))
			$wp_pinterest_pin_feed_uri = 'http://pinterest.com/'.$username.'/feed.rss';
		else $wp_pinterest_pin_feed_uri = 'http://pinterest.com/'.$username.'/'.$pinboardslug.'/rss';

		$wp_pinterest_rss = fetch_feed($wp_pinterest_pin_feed_uri);
		if (!is_wp_error( $wp_pinterest_rss )) {
			$max_pins = $wp_pinterest_rss->get_item_quantity((int)$pins);
			$get_pins = $wp_pinterest_rss->get_items(0, $max_pins);
		}
		else {
			$max_pins = 0;
			$get_pins = array();
		}
		
		if($pinwidth) {
			$pinwidthstyle = 'width:' . $pinwidth . 'px;';
			$pinwidthmarkup = 'width="' . $pinwidth . '"';
		} else $pinwidthstyle = $pinwidthmarkup = '';
		
		if($pinheight) {
			$pinheightstyle = 'height:' . $pinheight . 'px;';
			$pinheightmarkup = 'height="' . $pinheight . '"';
		} else {
			$pinheightstyle = 'height:auto !important;';
			$pinheightmarkup = '';
		}
		
		if($pinmaxheight) {
			$pinmaxheightstyle = 'max-height:' . $pinmaxheight . 'px;';
		} else $pinmaxheightstyle = '';
		
		$content .= '<div class="wp-pinterest-pinboard" style="-moz-column-count: '.$columns.';-webkit-column-count:'.$columns.';column-count:'.$columns.';">';
		foreach ($get_pins as $item) : 
			$content .= '<div class="wp-pinterest-pin" style="' . $pinwidthstyle . '">';
			$content .= '<a href="'.$item->get_permalink().'" title="'.$item->get_title().'... - Pinned on '.$item->get_date('M d, Y').'">';
			if ($thumb = $item->get_item_tags(SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail') ) {
				$thumb = $thumb[0]['attribs']['']['url'];
				$content .= '<img src="'.$thumb.'" style="' . $pinmaxheightstyle . $pinwidthstyle . $pinheightstyle . '"'; 
				$content .= ' alt="'.$item->get_title().'..." />';
			} else {
				preg_match('/src="([^"]*)"/', $item->get_content(), $matches);
				$src = $matches[1];
				if ($matches) {
					$content .= '<img src="'.$src.'" style="' . $pinmaxheightstyle . $pinwidthstyle . $pinheightstyle . '"'; 
					$content .= ' alt="'.$item->get_title().'..." />';
				} else {
				  $content .= "No image available";
				}
			}
			if($print_title == true) {
				$content .= '<div class="pin-title">' . $item->get_title().'...' . '</div>';
			}
			$content .= '</a>';
			$content .= '</div>';
		endforeach;
		$content .= '</div>';
		if($pinterest_link == 'large-white') 
			$content .= wp_pinterest_follow_button($username, 'large-white');
		elseif($pinterest_link == 'medium-white')
			$content .= wp_pinterest_follow_button($username, 'medium-white');
		elseif($pinterest_link == 'icon-white')
			$content .= wp_pinterest_follow_button($username, 'icon-white');
		elseif($pinterest_link == 'tiny-white')
			$content .= wp_pinterest_follow_button($username, 'tiny-white');
		elseif($pinterest_link == 'large-red')
			$content .= wp_pinterest_follow_button($username, 'large-red');
		elseif($pinterest_link == 'medium-red')
			$content .= wp_pinterest_follow_button($username, 'medium-red');
		elseif($pinterest_link == 'icon-red')
			$content .= wp_pinterest_follow_button($username, 'icon-red');
		elseif($pinterest_link == 'tiny-red')
			$content .= wp_pinterest_follow_button($username, 'tiny-red');
		elseif($pinterest_link == 'icon-text-white')
			$content .= '<a href="http://pinterest.com/' . $username . '/" title="Check out More pins from' . $username . '" class="wp-pinterest-icon-text-white">More Pins &#187;</a>';
		elseif($pinterest_link == 'icon-text-red')
			$content .= '<a href="http://pinterest.com/' . $username . '/" title="Check out More pins from' . $username . '" class="wp-pinterest-icon-text-red">More Pins &#187;</a>';
		else $content .= '';
			
		wp_pinterest('Pinboard');
		
		return $content;
	}
	
	add_filter('the_content', 'wp_pinterest_follow_button_control');
	
	// Pin-it button Option control
	function wp_pinterest_pin_it_button_control($content) {
	
		$options = get_option('wp_pinterest_options');
		$pin_it_button_layout = $options['wp_pinterest_pin_it_button_layout'];
		$full_post_position = $options['wp_pinterest_pin_it_button_single_display'];
		$full_page_position = $options['wp_pinterest_pin_it_button_page_display'];
		$excerpt_position = $options['wp_pinterest_pin_it_button_excerpt_display'];
		
		if($full_post_position == 'above' || $full_page_position == 'above' || $excerpt_position == 'above')
			$pin_it_button = wp_pinterest_pin_it_button($pin_it_button_layout) . $content;
		else if($full_post_position == 'below' || $full_page_position == 'below' || $excerpt_position == 'below')
			$pin_it_button = $content . wp_pinterest_pin_it_button($pin_it_button_layout);
		else
			$pin_it_button = $content;
			
		return $pin_it_button;
		
	}
	
	// Pinterest Follow button Option control
	function wp_pinterest_follow_button_control($content) {
	
		$options = get_option('wp_pinterest_options');
		$pinterest_username = $options['wp_pinterest_username'];
		$pinterest_follow_button_layout = $options['wp_pinterest_follow_button_layout'];
		$full_post_position = $options['wp_pinterest_follow_button_single_display'];
		$full_page_position = $options['wp_pinterest_follow_button_page_display'];
		$excerpt_position = $options['wp_pinterest_follow_button_excerpt_display'];
		
		if($full_post_position == 'above' || $full_page_position == 'above' || $excerpt_position == 'above')
			$pinterest_follow_button = wp_pinterest_follow_button($pinterest_username, $pinterest_follow_button_layout) . $content;
		else if($full_post_position == 'below' || $full_page_position == 'below' || $excerpt_position == 'below')
			$pinterest_follow_button = $content . wp_pinterest_follow_button($pinterest_username, $pinterest_follow_button_layout);
		else
			$pinterest_follow_button = $content;
		return $pinterest_follow_button;
	}
	
	// Pin-it button Shortcode
	function wp_pinterest_pin_it_button_shortcode($attr) {
	
		$defaults = array(
			'layout'	=>	'none',
		);
		
		extract(shortcode_atts($defaults, $attr));
		
		return wp_pinterest_pin_it_button($layout);
	}
	
	add_shortcode('pinit', 'wp_pinterest_pin_it_button_shortcode');
	
	// Pinterest Follow button Shortcode
	function wp_pinterest_follow_button_shortcode($attr) {
	
		$defaults = array(
			'username'	=>	'',
			'layout'	=>	'button'
		);
		
		extract(shortcode_atts($defaults, $attr));
		
		return wp_pinterest_follow_button($username, $layout);
	}
	
	add_shortcode('pinme', 'wp_pinterest_follow_button_shortcode');
	
	// Pinboard Shortcode
	function wp_pinterest_pinboard_shortcode($attr) {
	
		$defaults = array(
			'username'	=>	'',
			'board'		=>	'',
			'pins'		=>	'25',
			'width'		=>	'120',
			'height'	=>	'',
			'maxheight'	=>	'',
			'description'		=> 	'1',
			'follow'		=>	'',
			'columns'	=>	'1'
		);
		
		extract(shortcode_atts($defaults, $attr));
		
		return wp_pinterest_pinboard($username, $board, $pins, $width, $height, $maxheight, $description, $follow, $columns);
	}
	add_shortcode('pinboard', 'wp_pinterest_pinboard_shortcode');
	
	function wp_pinterest($string) {
		$wp_pinterest = '<!-- ';
		$wp_pinterest .= $string . ' Rendered by WP Pinterest 1.0 || http://techably.com/wp-pinterest-wordpress-plugin/';
		$wp_pinterest .= ' -->';
		echo $wp_pinterest."\n";
	}
	
	function wp_pinterest_pin_it_script() {
		echo '<script type="text/javascript" src="https://assets.pinterest.com/js/pinit.js"></script>';
	}
	
	if(wp_script_is('pinit', 'to_do')) {
		add_action('wp_head', 'wp_pinterest_pin_it_script');
	}
?>