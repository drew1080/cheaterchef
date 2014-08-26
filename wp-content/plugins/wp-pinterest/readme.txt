=== WP Pinterest ===
Contributors: Rahul Arora
Donate link: http://techably.com/
Tags: pinterest, pinit, pin, pinboard
Requires at least: 3.1
Tested up to: 3.4
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrates Pinterest and it's different assets and goodies with your WordPress site.

== Description ==

Add Pinterest assets like Pin-it button, Follow button and Pinboard to your WordPress site without hassle.

Links: [Plugin FAQ and News](http://techably.com/wp-pinterest-wordpress-plugin/7225/)

[PHP5 is required to avoid any problems with the plugin]

== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

1. Unzip the archive and put the `wp-pinterest` folder into `/wp-content/plugins/` directory.
2. Activate the plugin from the Plugins menu.

= Usage =

Use WP Pinterest Options page to configure Pin-it button and Follow button appearance, layout and positioning. Add a Pinboard widget by going to Appearance -> Widgets, drag 'WP Pinterest Pinboard Widget' to the sidebar and set the options needed.

WP-Admin -> Settings -> WP Pinterest

Make use of WP Pinterest shortcodes and PHP functions in case you don't have a widget-enabled theme.

== Shortcodes ==
	Pin-it button
		- Shortcode		:	[pinit]
		- Parameters	:	layout		// Button Layout
		- Usage			:	[pinit layout="horizontal|vertical|none"]

	Pinterest Follow button
		- Shortcode		:	[pinme]
		- Parameters	:	username, layout		// Pinterest Username, Button Layout
		- Usage			:	[pinme username="your_pinterest_username" layout="large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | icon-text"]

	Pinterest Pinboard
		- Shortcode		:	[pinboard]
		- Parameters	:	username, board, pins, width, height, maxheight, description, follow, columns		// Pinterest Username, Pinboard Name, Number of Pins to display, Pin width, Pin height, Pin maximum height, Show or hide description, Follow link below the Pinboard, Number of Columns the Pinboard should have
		- Usage			:	[pinboard username="your_pinterest_username" board="your_pinterest_board_name" pins="number_of_pins_to_display" width="width_of_a_pin" height="height_of_a_pin" maxheight="maximum_height_of_a_pin" description="0 | 1" follow="large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | icon-text | icon-text-red | icon-text-white | none" columns="number_of_columns_for_pinboard"]

== PHP functions ==

	Pin-it button
		Function		:	wp_pinterest_pin_it_button
		Parameters		:	$layout		// Button Layout
		Usage			:	`<?php wp_pinterest_pin_it_button('horizontal | vertical | none'); ?>`

	Pinterest Follow button
		Function		:	wp_pinterest_follow_button
		Parameters		:	$username, $layout		// Pinterest Username, Button Layout
		Usage			:	`<?php wp_pinterest_follow_button('your_pinterest_username', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red'); ?>`

	Pinterest Pinboard
		Function		:	wp_pinterest_pinboard
		Parameters		:	$username, $board, $pins, $width, $height, $maxheight, $description, $follow, $columns		// Pinterest Username, Pinboard Name, Number of Pins to display, Pin width, Pin height, Pin maximum height, Show or hide description, Follow link below the Pinboard, Number of Columns the Pinboard should have
		Usage			:	`<?php wp_pinterest_pinboard('your_pinterest_username', 'your_pinterest_board_name', 'number_of_pins_to_display', 'width_of_a_pin', 'height_of_a_pin', 'maximum_height_of_a_pin', '0 | 1', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | icon-text | icon-text-red | icon-text-white | none', 'number_of_columns_for_pinboard'); ?>`

	= NOTE: The parameters 'pins', 'width', 'height', 'maxheight', 'columns' should be supplied an integer value only. Parameter 'description', which controls showing/hiding of Pin title on Pinboard, is a binary parameter which should be provided with a value either '0' (false) or '1' (true).
			Implement the best practice to use PHP functions in your WordPress Theme by following the below given example:
			`<?php if(function_exists('wp_pinterest_follow_button')) echo wp_pinterest_follow_button('your_pinterest_username', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red'); ?>`

== Screenshots ==

1. Options page
2. Pinboard Widget
3. Pin-it and Follow buttons

== Frequently Asked Questions ==

1.	How can I display Pin-it button on my WordPress site?
	Make use of WP Pinterest Options to set the Pin-it button on your WordPress posts, pages and excerpts.
	
2.	Can I use any shortcode to display the Pin-it button?
	Yes. You can use shortcode [pinit] to display the Pin-it button inside a post, page or a widget.
	The shortcode [pinit] displays Pin-it button with no-count by default. But you can control the Pin-it button layout from the shortcode this way: [pinit layout="horizontal | vertical | none"].

3.	What if I want to display Pin-it button through my Theme directly? Can I use a PHP function supported by the plugin to do so?
	Yes. Use `<?php echo wp_pinterest_pin_it_button('horizontal | vertical | none'); ?>` function in your WordPress theme to display Pin-it button via PHP.
		
4.	Okay, how to display Pinterest follow button now?
	Go to WP Pinterest Options and set the Pinterest Follow button to appear on your WordPress posts, pages and excerpts.

5.	Any shortcode for the Pinterest Follow button?
	Yes. Use the shortcode [pinme] to display the Follow button inside a post, page or a widget. Supply your username this way: [pinme username="your_pinterest_username"]
	The shortcode will display them small-red Pinterest Follow button by default. You can control the button's layout from the shortcode this way: [pinit username="your_pinterest_username" layout="large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red"].

6.	Can I display Pinterest Follow button through a PHP function in my Theme?
	Yes. Use `<?php echo wp_pinterest_follow_button('your_pinterest_username', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red'); ?>` function in your WordPress theme to display the follow button via PHP.

7.	How to use Pinboard widget?
	As simple as you use widgets on your WordPress. Just drag-drop the widget to your sidebar and input the required information.
		- Username field is required. Here, you should enter your Pinterest username.
		- Pinboard name field is optional. If you want to input a Pinboard name, go to your Pinboards on Pinterest, copy a board's name and put it in there.
		  If you leave the Pinboard name field blank, the widget will automatically show your recent pins.
		- You can specify the width of your pins through Pin Width field, but it is completely optional.
		- Similarly, you can specify the height of pins in the Pin Height field, it is optional too.
		- Next field, the Maximum Pin Height field helps you to control the maximum width of your pins. Say if you have a very heighty image in your pins, you might utilize this field to specify a height limit for such pins. Optional.
			= NOTE: Leave 'Pin Height' blank in order to use this attribute, since 'Pin Height' is already fixing the height of the pins, declaring Pin Maximum Height will be of no use, if you're already using 'Pin Height' field.
		- With the next option, You can show / hide Pin Description to appear with Pins in the Pinboard. Pin description is shown by default.
		- In the next option, you can show a Pinterest Follow button or 'More Pins' link beneath your Pinboard. This is also an optional field. If left blank, the icon-text-white i.e. small-white Pinterest icon with text "More Pins" will be shown.
		- Last option lets you specify the number of columns for the Pinboard. While using more than single column, adjust 'Pin Width' to get the best layout for your pinboard.

8.	Can I display the Pinboard through a shortcode?
	Yes. The shortcode [pinboard] lets you display the Pinboard inside a post, page or a text widget.
	Use the Pinboard shortcode this way: [pinboard username="your_pinterest_username" pinboard="your_pinboard_name" pins="number_of_pins_to_show" pinwidth="width_of_a_pin(optional)" pinheight="height_of_a_pin(optional)" pinmaxheight="maximum-height-of-a-pin(optional)" title="0|1" link="large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | text-icon-white | text-icon-red" columns="number_of_columns_pinboard_should_have"]
	
9.	What's the PHP function to show the Pinboard?
	Use this function to show the Pinboard through PHP:
	`<?php echo wp_pinterest_pinboard('your_pinterest_username', 'your_pinboard_name', 'number_of_pins_to_show', 'width_of_a_pin', 'height_of_a_pin', 'maximum-height-of-a-pin', '0|1', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | icon-text-white | icon-text-red', 'number_of_columns_pinboard_should_have'); ?>`
	In case you want to skip an option in the function, leave the option blank, i.e.
		`<?php echo wp_pinterest_pinboard('your_pinterest_username', '', 'number_of_pins_to_show', '', '', '', '0|1', 'large-white | medium-white | icon-white | tiny-white | large-red | medium-red | icon-red | tiny-red | text-icon-white | text-icon-red', 'number_of_columns_pinboard_should_have'); ?>`
		
== Changelog ==

= 1.0 (2012-07-01) =

== Upgrade Notice ==

For more help and support, see the plugin's official page: http://techably.com/wp-pinterest-wordpress-plugin/7225/
email: rahul@techably.com