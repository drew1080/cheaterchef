<?php
/**
 *	WP Pinterest (wp-pinterest.php) admin options extended
 *
 *	Admin options needed in wp-pinterest.php
 *
 *	@package WordPress
 *	@subpackage WP Pinterest
 */

	function wp_pinterest_options() {

		add_submenu_page (
			'options-general.php',
			'WP Pinterest: Options',
			'WP Pinterest',
			'administrator',
			'wp_pinterest_options',
			'wp_pinterest_options_render'
		);
		
	}

	add_action('admin_menu', 'wp_pinterest_options');

	function wp_pinterest_options_render() {  ?>
  
		<div class="wrap about-wrap">
			<div class="wp-pinterest-clearfix">
				<h1 class="wp-pinterest-floatleft plugin-title">WP Pinterest: Options</h1>
				<ul class="wp-pinterest-recommend wp-pinterest-floatleft">
				<li><iframe src="//www.facebook.com/plugins/like.php?href=http://techably.com/wp-pinterest-wordpress-plugin/7225/%2F&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
				</li>
				<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://techably.com/wp-pinterest-wordpress-plugin/7225/" data-text="Check our WP Pinterest to Integrate Pinterest with WordPress" data-via="techably" data-related="techably" data-hashtags="WPPinterest">Tweet</a></li>
				<li><a href="http://pinterest.com/pin/create/button/?url=http://techably.com/wp-pinterest-wordpress-plugin/7225/&media=&description=WP Pinterest WordPress Plugin" class="pin-it-button" count-layout="horizontal">Pin It</a></li>
				<li><div class="g-plusone" data-size="medium" data-href="http://techably.com/wp-pinterest-wordpress-plugin/7225/"></div></li>
				</ul>
			</div>
			<script src="//platform.twitter.com/widgets.js"></script>
			<script src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
			<div class="about-text wp-pinterest-intro wp-pinterest-clearfix">
				<p>Add Pinterest Pin-it button, Follow button and Pinboards automatically to your WordPress with <b>WP Pinterest</b>. The plugin also allows you to use shortcodes and PHP function for advanced implementation.</p>
				<p>Setup the Pin-it and Follow buttons below or <a href="<?php echo get_option('home'); ?>/wp-admin/widgets.php" title="Add Pinboard Widget">Add a Pinboard to your Sidebar</a>.</p>
				<small class="wp-pinterest-floatright"><a href="http://techably.com/wp-pinterest-wordpress-plugin/7225/" title="WP Pinterest Help, Support and FAQ" target="_blank">WP Pinterest Help, Support and FAQ</a></small>
			</div>
			<style type="text/css">
.wp-pinterest-recommend { margin:1.5em 0 0 2em;}
.plugin-title{display:inline-block;}
.wp-pinterest-recommend li {float:left;max-width:80px;}
.wp-pinterest-clearfix:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
* html .wp-pinterest-clearfix,*:first-child+html .wp-pinterest-clearfix{zoom:1px;}
.wp-pinterest-floatleft { float:left;}
.wp-pinterest-floatright { float:right;}
.wp-pinterest-intro {border:1px solid #ccc;border-width:1px 0;width:100%;}
			</style>
			<?php settings_errors(); ?>
			<form name="wp_pinterest" method="post" action="options.php">
				<?php 
					settings_fields('wp_pinterest_options');
					do_settings_sections('wp_pinterest_options');
					submit_button();
				?>
			</form>
		</div>
	<?php
	
	}

	add_action('admin_init', 'wp_pinterest_settings');  

	function wp_pinterest_settings() {

		if(false == get_option('wp_pinterest_options')) {
			add_option('wp_pinterest_options');
		}

		add_settings_section (
			'wp_pinterest_pin_it_button_section',
			'Pin-it Button Options',
			'wp_pinterest_pin_it_button_section_render',
			'wp_pinterest_options'
		);
		
		add_settings_field (  
			'wp_pinterest_pin_it_button_layout',
			'Pin-it button Layout',
			'wp_pinterest_pin_it_button_layout_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_pin_it_button_preview',
			'Pin-it button preview',
			'wp_pinterest_pin_it_button_preview_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_default_pin_img',
			'Fallback Pin Image',
			'wp_pinterest_default_pin_img_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				'<br/>This image will be used when the post doesn\'t have any images (optional).'
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_pin_it_button_single_display',
			'Display Pin-it button in Posts',
			'wp_pinterest_pin_it_button_single_display_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_pin_it_button_page_display',
			'Display Pin-it button in Pages',
			'wp_pinterest_pin_it_button_page_display_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_pin_it_button_excerpt_display',
			'Display Pin-it button in Excerpts',
			'wp_pinterest_pin_it_button_excerpt_display_render',
			'wp_pinterest_options',
			'wp_pinterest_pin_it_button_section',
			array(
				''  
			)  
		);
		
		add_settings_section (
			'wp_pinterest_follow_button_section',
			'Follow Button Options',
			'wp_pinterest_follow_button_section_render',
			'wp_pinterest_options'
		);
		
		add_settings_field (  
			'wp_pinterest_username',
			'Pinterest Username',
			'wp_pinterest_username_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				'<br/>Required!'  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_follow_button_layout',
			'Follow button Styles',
			'wp_pinterest_follow_button_layout_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_follow_button_preview',
			'Follow button preview',
			'wp_pinterest_follow_button_preview_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_follow_button_single_display',
			'Display Follow button in Posts',
			'wp_pinterest_follow_button_single_display_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_follow_button_page_display',
			'Display Follow button in Pages',
			'wp_pinterest_follow_button_page_display_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				''  
			)  
		);
		
		add_settings_field (  
			'wp_pinterest_follow_button_excerpt_display',
			'Display Follow button in Excerpts',
			'wp_pinterest_follow_button_excerpt_display_render',
			'wp_pinterest_options',
			'wp_pinterest_follow_button_section',
			array(
				''  
			)  
		);
		
		register_setting('wp_pinterest_options', 'wp_pinterest_options');
		
	}

	function wp_pinterest_pin_it_button_section_render() {  
	
		$html = '<p class="description">Adjust the display, appearance and position of your Pin-it button</p>';
		$html .= '<p>Use the below options to automatically add Pinterest Pin-it button on your WordPress site.</p>';
		echo $html;  
		
	}
	
	function wp_pinterest_default_pin_img_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<input type="text" id="wp_pinterest_default_pin_img" name="wp_pinterest_options[wp_pinterest_default_pin_img]" value="' . $options['wp_pinterest_default_pin_img'] . '" style="width:250px;" />';
		$html .= '<label for="wp_pinterest_default_pin_img">' . $args[0] . '</label>';
		echo $html;
		
	}
	
	function wp_pinterest_pin_it_button_layout_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_pin_it_button_layout" name="wp_pinterest_options[wp_pinterest_pin_it_button_layout]" onchange="preview_pin_it()">';
		$html .= '<option value="horizontal"' . selected($options['wp_pinterest_pin_it_button_layout'], 'horizontal', false) . '>Horizontal</option>';
		$html .= '<option value="vertical"' . selected($options['wp_pinterest_pin_it_button_layout'], 'vertical', false) . '>Vertical</option>';
		$html .= '<option value="none"' . selected($options['wp_pinterest_pin_it_button_layout'], 'none', false) . '>None</option>';
		$html .= '</select>';
		echo $html;  
		
	}
	
	function wp_pinterest_pin_it_button_single_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_pin_it_button_single_display" name="wp_pinterest_options[wp_pinterest_pin_it_button_single_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_pin_it_button_single_display'], 'none', false) . '>Do not display with posts</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_pin_it_button_single_display'], 'above', false) . '>Above the Post Content</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_pin_it_button_single_display'], 'below', false) . '>Below the Post content</option>';
		$html .= '</select>';
		echo $html;  
		
	}

	function wp_pinterest_pin_it_button_page_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_pin_it_button_page_display" name="wp_pinterest_options[wp_pinterest_pin_it_button_page_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_pin_it_button_page_display'], 'none', false) . '>Do not display with pages</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_pin_it_button_page_display'], 'above', false) . '>Above the Page Content</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_pin_it_button_page_display'], 'below', false) . '>Below the Page content</option>';
		$html .= '</select>';
		echo $html;
		
	}

	function wp_pinterest_pin_it_button_excerpt_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_pin_it_button_excerpt_display" name="wp_pinterest_options[wp_pinterest_pin_it_button_excerpt_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_pin_it_button_excerpt_display'], 'none', false) . '>Do not display with excerpts</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_pin_it_button_excerpt_display'], 'above', false) . '>Above the Excerpt</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_pin_it_button_excerpt_display'], 'below', false) . '>Below the Excerpt</option>';
		echo $html;
		
	}

	function wp_pinterest_pin_it_button_preview_render() {
	
		$wp_pinterest_pin_it_vertical = plugins_url('images/pinterest-vertical.png', __FILE__);
		$wp_pinterest_pin_it_horizontal = plugins_url('images/pinterest-horizontal.png', __FILE__);
		$wp_pinterest_pin_it_none = plugins_url('images/pinterest-none.png', __FILE__);

		?>
		
		<script type="text/javascript">
			function preview_pin_it() {
				var layout = document.getElementById('wp_pinterest_pin_it_button_layout').value;
				if(layout == 'vertical')
					var preview = '<img src="<?php echo $wp_pinterest_pin_it_vertical; ?>" alt="Pin it" title="Pin-it button vertical count" />';
				else if (layout == 'horizontal')
					var preview = '<img src="<?php echo $wp_pinterest_pin_it_horizontal; ?>" alt="Pin it" title="Pin-it button with horizontal count" />';
				else
					var preview = '<img src="<?php echo $wp_pinterest_pin_it_none; ?>" alt="Pin it" title="Pin-it button with no count" />';
				document.getElementById('preview-pin-it').innerHTML = preview;
			}
		</script>
		
		<div id="preview-pin-it"><script type="text/javascript">preview_pin_it(); </script></div>
		<?php
		
	}

	function wp_pinterest_follow_button_section_render() {  
	
		$html = '<p class="description">Adjust the display, appearance and position of your Pinterest Follow button</p>';  
	$html .= '<p>Use the below options to automatically add Pinterest follow button on your WordPress site.</p>';
		echo $html;  
		
	}
	
	function wp_pinterest_username_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<input type="text" id="wp_pinterest_username" name="wp_pinterest_options[wp_pinterest_username]" value="' . $options['wp_pinterest_username'] . '" />';
		$html .= '<label for="wp_pinterest_username">' . $args[0] . '</label>';
		echo $html;
		
	}

	function wp_pinterest_follow_button_layout_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_follow_button_layout" name="wp_pinterest_options[wp_pinterest_follow_button_layout]" onchange="preview_follow()">';
		$html .= '<optgroup label="White buttons">';
		$html .= '<option value="large-white"' . selected($options['wp_pinterest_follow_button_layout'], 'large-white', false) . '>Large</option>';
		$html .= '<option value="medium-white"' . selected($options['wp_pinterest_follow_button_layout'], 'medium-white', false) . '>Medium</option>';
		$html .= '<option value="icon-white"' . selected($options['wp_pinterest_follow_button_layout'], 'icon-white', false) . '>Icon</option>';
		$html .= '<option value="tiny-white"' . selected($options['wp_pinterest_follow_button_layout'], 'tiny-white', false) . '>Tiny</option>';
		$html .= '</optgroup>';
		$html .= '<optgroup label="Red buttons">';
		$html .= '<option value="large-red"' . selected($options['wp_pinterest_follow_button_layout'], 'large-red', false) . '>Large</option>';
		$html .= '<option value="medium-red"' . selected($options['wp_pinterest_follow_button_layout'], 'medium-red', false) . '>Medium</option>';
		$html .= '<option value="icon-red"' . selected($options['wp_pinterest_follow_button_layout'], 'icon-red', false) . '>Icon</option>';
		$html .= '<option value="tiny-red"' . selected($options['wp_pinterest_follow_button_layout'], 'tiny-red', false) . '>Tiny</option>';
		$html .= '</optgroup>';
		$html .= '</select>';
		echo $html;  
		
	}

	function wp_pinterest_follow_button_single_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_follow_button_single_display" name="wp_pinterest_options[wp_pinterest_follow_button_single_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_follow_button_single_display'], 'none', false) . '>Do not display with posts</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_follow_button_single_display'], 'above', false) . '>Above the Post Content</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_follow_button_single_display'], 'below', false) . '>Below the Post content</option>';
		$html .= '</select>';
		echo $html;  
		
	}

	function wp_pinterest_follow_button_page_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_follow_button_page_display" name="wp_pinterest_options[wp_pinterest_follow_button_page_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_follow_button_page_display'], 'none', false) . '>Do not display with pages</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_follow_button_page_display'], 'above', false) . '>Above the Page Content</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_follow_button_page_display'], 'below', false) . '>Below the Page content</option>';
		$html .= '</select>';
		echo $html;
		
	}

	function wp_pinterest_follow_button_excerpt_display_render($args) {
	
		$options = get_option('wp_pinterest_options');
		$html = '<select id="wp_pinterest_follow_button_excerpt_display" name="wp_pinterest_options[wp_pinterest_follow_button_excerpt_display]">';
		$html .= '<option value="none"' . selected($options['wp_pinterest_follow_button_excerpt_display'], 'none', false) . '>Do not display with excerpts</option>';
		$html .= '<option value="above"' . selected($options['wp_pinterest_follow_button_excerpt_display'], 'above', false) . '>Above the Excerpt</option>';
		$html .= '<option value="below"' . selected($options['wp_pinterest_follow_button_excerpt_display'], 'below', false) . '>Below the Excerpt</option>';
		echo $html;
		
	}
	
	function wp_pinterest_follow_button_preview_render() {
	
		$wp_pinterest_large_white = plugins_url('images/follow-me-on-pinterest-button.png', __FILE__);
		$wp_pinterest_medium_white = plugins_url('images/pinterest-button.png', __FILE__);
		$wp_pinterest_icon_white = plugins_url('images/big-p-button.png', __FILE__);
		$wp_pinterest_tiny_white = plugins_url('images/small-p-button.png', __FILE__);
		$wp_pinterest_large_red = plugins_url('images/follow-on-pinterest-button.png', __FILE__);
		$wp_pinterest_medium_red = plugins_url('images/pinterest-button-red.png', __FILE__);
		$wp_pinterest_icon_red = plugins_url('images/big-p-button-red.png', __FILE__);
		$wp_pinterest_tiny_red = plugins_url('images/small-p-button-red.png', __FILE__);
		
		?>
		
		<script type="text/javascript">
			function preview_follow() {
				var layout = document.getElementById('wp_pinterest_follow_button_layout').value;
				if (layout == 'large-white')
					var preview = '<img src="<?php echo $wp_pinterest_large_white; ?>" alt="Large white" title="Large white" />';
				else if (layout == 'medium-white')
					var preview = '<img src="<?php echo $wp_pinterest_medium_white; ?>" alt="Medium white" title="Medium white" />';
				else if (layout == 'icon-white')
					var preview = '<img src="<?php echo $wp_pinterest_icon_white; ?>" alt="Icon white" title="Icon white" />';
				else if (layout == 'tiny-white')
					var preview = '<img src="<?php echo $wp_pinterest_tiny_white; ?>" alt="Tiny white" title="Tiny white" />';
				else if (layout == 'large-red')
					var preview = '<img src="<?php echo $wp_pinterest_large_red; ?>" alt="Large red" title="Large red" />';
				else if (layout == 'medium-red')
					var preview = '<img src="<?php echo $wp_pinterest_medium_red; ?>" alt="Medium red" title="Medium red" />';
				else if (layout == 'icon-red')
					var preview = '<img src="<?php echo $wp_pinterest_icon_red; ?>" alt="Icon red" title="Icon red" />';
				else
					var preview = '<img src="<?php echo $wp_pinterest_tiny_red; ?>" alt="Tiny red" title="Tiny red" />';
				document.getElementById('preview-follow').innerHTML = preview;
			}
		</script>
		
		<div id="preview-follow"><script type="text/javascript">preview_follow(); </script></div>
		<?php
		
	}

?>