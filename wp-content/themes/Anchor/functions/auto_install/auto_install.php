<?php 
global $wpdb;
$a = get_option('supreme_theme_settings');
if(!isset($a['supreme_show_breadcrumb']))
{
	$b = array(
			'supreme_show_breadcrumb'			=> 1,
			'supreme_site_description' 			=> $a['supreme_site_description'],
			'supreme_archive_display_excerpt' 	=> $a['supreme_archive_display_excerpt'],
			'supreme_frontpage_display_excerpt' => $a['supreme_frontpage_display_excerpt'],
			'supreme_search_display_excerpt' 	=> $a['supreme_search_display_excerpt'],
			'supreme_header_primary_search' 	=> $a['supreme_header_primary_search'],
			'supreme_header_secondary_search' 	=> $a['supreme_header_secondary_search'],
			'supreme_author_bio_posts' 			=> $a['supreme_author_bio_posts'],
			'supreme_author_bio_pages' 			=> $a['supreme_author_bio_pages'],
			'supreme_global_layout' 			=> $a['supreme_global_layout'],
			'supreme_bbpress_layout' 			=> $a['supreme_bbpress_layout'],
			'supreme_buddypress_layout' 		=> $a['supreme_buddypress_layout']
	);
	
update_option('supreme_theme_settings',$b);
}
if( get_option('ptthemes_auto_install') == 'No' || get_option('ptthemes_auto_install') == ''){
	global $pagenow;
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( false == get_option( 'hide_ajax_notification' ) ) {
		add_action("admin_head", "anchor_autoinstall"); // please comment this line if you wish to DEACTIVE SAMPLE DATA INSERT.
	}
}

add_action('admin_head','add_css_to_admin');
function add_css_to_admin(){
	echo '<style type="text/css">
		#message1{
			display:none;
		}
	</style>';
}
function activate_eco_addons(){
	$url_custom_field = site_url()."/wp-admin/admin.php?page=templatic_system_menu&activated=custom_fields_templates&true=1";
	$url_custom_post_type = site_url()."/wp-admin/admin.php?page=templatic_system_menu&activated=custom_taxonomy&true=1";
	add_css_to_admin();
?>
		
	<div class="error" style="padding:10px 0 10px 10px;font-weight:bold;">
		<span>
			<?php _e('Thanks for choosing templatic themes,  the base system of templatic is not installed at your side Now, Please activate both <a id="templatic_plugin" href="'.$url_custom_post_type.'" style="color:#21759B">Templatic - Custom Post Types Manager</a> and <a  href="'.$url_custom_field.'" style="color:#21759B">Templatic - Custom Fields</a> addons to start your journey of <b>'.wp_get_theme().'</b>.',"templatic");?>
		</span>
	</div>
	
<?php 
	} 
function anchor_autoinstall(){
	global $wpdb;
	$wp_user_roles_arr = get_option($wpdb->prefix.'user_roles');
	global $wpdb;
	if((strstr($_SERVER['REQUEST_URI'],'themes.php') && !isset($_REQUEST['page'])) && @$_REQUEST['template']=='' || (isset($_REQUEST['page']) && $_REQUEST['page']=="templatic_system_menu") ){
	
		$post_counts = $wpdb->get_var("select count(post_id) from $wpdb->postmeta where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content') and meta_value=1");
		if($post_counts>0){
			$theme_name = get_option('stylesheet');
			$nav_menu = get_option('theme_mods_'.strtolower($theme_name));
			if($nav_menu['nav_menu_locations']['secondary'] == 0){
				$menu_msg = "<p><b>NAVIGATION MENU:</b> <a href='".site_url("/wp-admin/nav-menus.php")."'><b>Setup your Menu here</b></a>  | <b>CUSTOMIZE:</b> <a href='".site_url("/wp-admin/customize.php")."'><b>Customize your Theme Options.</b></a><br/> <b>HELP:</b> <a href='http://templatic.com/docs/anchor/'> <b>Theme Documentation Guide</b></a> | <b>SUPPORT:</b><a href='http://templatic.com/forums'> <b>Community Forum</b></a></p>";
			}else{
				$menu_msg="<p><b>CUSTOMIZE:</b> <a href='".site_url("/wp-admin/customize.php")."'><b>Customize your Theme Options.</b></a><br/> <b>HELP:</b> <a href='http://templatic.com/docs/anchor/'> <b>Theme Documentation Guide</b></a> | <b>SUPPORT:</b><a href='http://templatic.com/forums'> <b>Community Forum</b></a></p>";
			}			
			$dummy_data_msg = 'Sample data has been <b>populated</b> on your site. Your sample portal website is ready, click <strong><a href='.site_url().'>here</a></strong> to see how its looks.'.$menu_msg.'<p> Wish to delete sample data?  <a class="button_delete button-primary" href="'.home_url().'/wp-admin/themes.php?dummy=del">Yes Delete Please!</a></br><strong>Note: </strong>In case you modified the dummy content, pressing on the above button will undo all your changes.</p>';
		}else{
			$theme_name = get_option('stylesheet');
			$nav_menu = get_option('theme_mods_'.strtolower($theme_name));
			if(@$nav_menu['nav_menu_locations']['secondary'] == 0){
				$menu_msg1 = "<p><b>NAVIGATION MENU:</b> <a href='".site_url("/wp-admin/nav-menus.php")."'><b>Setup your Menu here</b></a>  | <b>CUSTOMIZE:</b> <a href='".site_url("/wp-admin/customize.php")."'><b>Customize your Theme Options.</b></a><br/> <b>HELP:</b> <a href='http://templatic.com/docs/anchor/'> <b>Theme Documentation Guide</b></a> | <b>SUPPORT:</b><a href='http://templatic.com/forums'> <b>Community Forum</b></a></p>";
			}else{
				$menu_msg1="<p><b>CUSTOMIZE:</b> <a href='".site_url("/wp-admin/customize.php")."'><b>Customize your Theme Options.</b></a><br/> <b>HELP:</b> <a href='http://templatic.com/docs/anchor/'> <b>Theme Documentation Guide</b></a> | <b>SUPPORT:</b><a href='http://templatic.com/forums'> <b>Community Forum</b></a></p>";
			}
			$dummy_data_msg = 'Install sample data: Would you like to <b>auto populate</b> sample data on your site?  <a class="button_insert button-primary" href="'.home_url().'/wp-admin/themes.php?dummy_insert=1">Yes, insert please</a>'.$menu_msg1;
		}
		
		if(isset($_REQUEST['dummy_insert']) && $_REQUEST['dummy_insert']){
			require_once (get_stylesheet_directory().'/functions/auto_install/auto_install_data.php');
			wp_redirect(admin_url().'themes.php');
		}
		if(isset($_REQUEST['dummy']) && $_REQUEST['dummy']=='del'){
			anchor_delete_dummy_data();
			wp_redirect(admin_url().'themes.php');
		}
		
		define('THEME_ACTIVE_MESSAGE','<div id="ajax-notification" class="updated templatic_autoinstall"><p> '.$dummy_data_msg.'</p><span id="ajax-notification-nonce" class="hidden">' . wp_create_nonce( 'ajax-notification-nonce' ) . '</span><a href="javascript:;" id="dismiss-ajax-notification" class="templatic-dismiss" style="float:right">Dismiss</a></div>');
		echo THEME_ACTIVE_MESSAGE;
	}
}
//<div class="updated highlight fade"> '.@$theme_actived_success.@$dummy_deleted.$dummy_data_msg.'</div>');
function anchor_delete_dummy_data()
{
	global $wpdb;
	delete_option('sidebars_widgets'); //delete widgets
	$productArray = array();
	$pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content' || meta_key='auto_install') and (meta_value=1 || meta_value='auto_install')";
	$pids_info = $wpdb->get_results($pids_sql);
	foreach($pids_info as $pids_info_obj)
	{
		wp_delete_post($pids_info_obj->ID,true);
	}
}
?>