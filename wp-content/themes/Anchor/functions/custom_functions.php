<?php

/*
Name : bdw_get_images_with_info
Desc : Fetch resize images
*/
function bdw_get_images_anchor($iPostID,$img_size='thumb') 
{ 
    $arrImages =& get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	$return_arr = array();
	if (has_post_thumbnail( $iPostID )){
		$img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $iPostID ), $img_size );
		$imgarr['id'] = $id;
		$imgarr['file'] = $img_arr[0];
		$return_arr[] = $imgarr;
	}
	else
	{
		if($arrImages) 
		{		
		   foreach($arrImages as $key=>$val)
		   {
				$id = $val->ID;
				if($img_size == 'large')
				{
					$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
					$imgarr['id'] = $id;
					$imgarr['file'] = $img_arr[0];
					$return_arr[] = $imgarr;
				}
				elseif($img_size == 'medium')
				{
					$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
					$imgarr['id'] = $id;
					$imgarr['file'] = $img_arr[0];
					$return_arr[] = $imgarr;
				}
				elseif($img_size == 'thumb')
				{
					$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
					$imgarr['id'] = $id;
					$imgarr['file'] = $img_arr[0];
					$return_arr[] = $imgarr;
					
				}
				else
				{
					$img_arr = wp_get_attachment_image_src($id, $img_size); // Get the thumbnail url for the attachment
					$imgarr['id'] = $id;
					$imgarr['file'] = $img_arr[0];
					$return_arr[] = $imgarr;
					
				}
		   }
		}
	}
	return $return_arr;
}


/* 
Name : anchor_excerpt
Desc : Variable & intelligent excerpt length.
*/
function anchor_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).'...';
  } else {
	$excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
 }

/* 
Name : get_url_var
Desc : Fetch page number from url in pagination
*/

function anchor_get_url_var($name)
{
    $strURL = $_SERVER['REQUEST_URI'];
    $arrVals = split("/",$strURL);
    $found = 0;
    foreach ($arrVals as $index => $value) 
    {
        if($value == $name) $found = $index;
    }
    $place = $found + 1;
    return $arrVals[$place];
}


/*	Function to add theme color settings options in wordpress customizer START	*/
	function anchor_register_customizer_settings($wp_customize){
		/*	Add Settings START */
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color1]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color1",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color1",
				//'transport' => 'postMessage',
			));
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color2]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color2",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color2",
				//'transport' => 'postMessage',
			));
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color3]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color3",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color3",
				//'transport' => 'postMessage',
			));
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color4]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color4",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color4",
				//'transport' => 'postMessage',
			));
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color5]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color5",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color5",
				//'transport' => 'postMessage',
			));
			
			$wp_customize->add_setting('supreme_theme_settings[color_picker_color6]',array(
				'default' => '',
				'type' => 'option',
				'capabilities' => 'edit_theme_options',
				'sanitize_callback' => 	"anchor_customize_supreme_color6",
				'sanitize_js_callback' => 	"anchor_customize_supreme_color6",
				//'transport' => 'postMessage',
			));
			
		/* Add Control START */	
		/*
			Primary: 	 Effect on buttons, links and main headings.
			Secondary: 	 Effect on sub-headings.
			Content: 	 Effect on content.
			Sub-text: 	 Effect on sub-texts.
			Background:  Effect on body & menu background. 
		
		*/
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_picker_color1', array(
				'label'   => __( 'Change color of Body Background', T_DOMAIN),
				'section' => 'colors',
				'settings'   => 'supreme_theme_settings[color_picker_color1]',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_picker_color2', array(
				'label'   => __( 'Change color of Header and Footer', T_DOMAIN ),
				'section' => 'colors',
				'settings'   => 'supreme_theme_settings[color_picker_color2]',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_picker_color3', array(
				'label'   => __( 'Change color of Buttons, Headings, Titles and Pagination, Input text', T_DOMAIN ),
				'section' => 'colors',
				'settings'   => 'supreme_theme_settings[color_picker_color3]',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_picker_color4', array(
				'label'   => __( 'Change color of Button Hover', T_DOMAIN ),
				'section' => 'colors',
				'settings'   => 'supreme_theme_settings[color_picker_color4]',
			) ) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_picker_color5', array(
				'label'   => __( 'Change color of Content text, Input text', T_DOMAIN ),
				'section' => 'colors',
				'settings'   => 'supreme_theme_settings[color_picker_color5]',
			) ) );
			
			$wp_customize->remove_control('background_color');
			//$wp_customize->remove_control('supreme_search_display_excerpt');
			//$wp_customize->remove_control('supreme_global_layout');
	}		

	/*  Handles changing settings for the live preview of the theme START.  */	
	function anchor_customize_supreme_color1( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color1]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color1", $setting, $object );
	}	
	function anchor_customize_supreme_color2( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color2]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color2", $setting, $object );
	}	
	function anchor_customize_supreme_color3( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color3]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color3", $setting, $object );
	}	
	function anchor_customize_supreme_color4( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color4]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color4", $setting, $object );
	}
	function anchor_customize_supreme_color5( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color5]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color5", $setting, $object );
	}
	
	function anchor_customize_supreme_color6( $setting, $object ) {
		
		/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
		if ( "supreme_theme_settings[color_picker_color6]" == $object->id && !current_user_can( 'unfiltered_html' )  )
			$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
		/* Return the sanitized setting and apply filters. */
		return apply_filters( "anchor_customize_supreme_color6", $setting, $object );
	}
	

/*	Function to add theme color settings options in wordpress customizer END	*/






/* THEME UPDATE CODING START */
//Theme update templatic menu
function Anchor_tmpl_theme_update(){
	require_once(get_stylesheet_directory()."/templatic_login.php");
}


/* Theme update templatic menu*/
function Anchor_tmpl_support_theme(){
	echo "<h3>Need Help?</h3>";
	echo "<p>Here's how you can get help from templatic on any thing you need with regarding this theme. </p>";
	echo "<br/>";
	echo '<p><a href="http://templatic.com/docs/anchor/" target="blank">'."Take a look at theme guide".'</a></p>';
	echo '<p><a href="http://templatic.com/docs/" target="blank">'."Knowlegebase".'</a></p>';
	echo '<p><a href="http://templatic.com/forums/" target="blank">'."Explore our community forums".'</a></p>';
	echo '<p><a href="http://templatic.com/helpdesk/" target="blank">'."Create a support ticket in Helpdesk".'</a></p>';
}

/* Theme update templatic menu*/
function Anchor_tmpl_purchase_theme(){
	wp_redirect( 'http://templatic.com/wordpress-themes-store/' ); 
	exit;
}

add_action('admin_menu','Anchor_theme_menu',11); // add submenu page 
add_action('admin_menu','delete_Anchor_templatic_menu',11);
function Anchor_theme_menu(){
	
	add_submenu_page( 'templatic_menu', 'Theme Update','Theme Update', 'administrator', 'Anchor_tmpl_theme_update', 'Anchor_tmpl_theme_update',27 );
	
	add_submenu_page( 'templatic_menu', 'Framework Update','Framework Update', 'administrator', 'tmpl_framework_update', 'tmpl_framework_update',28 );
	
	add_submenu_page( 'templatic_menu', 'Get Support' ,'Get Support' , 'administrator', 'Anchor_tmpl_support_theme', 'Anchor_tmpl_support_theme',29 );
	
	add_submenu_page( 'templatic_menu', 'Purchase theme','Purchase theme', 'administrator', 'Anchor_tmpl_purchase_theme', 'Anchor_tmpl_purchase_theme',30 );
}


/*
	Realtr delete menu 
*/	
function delete_Anchor_templatic_menu(){
	remove_submenu_page('templatic_menu', 'templatic_menu'); 
}

/* THEME UPDATE CODING END */


?>