<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package supreme
 * @subpackage Template
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>
    <?php hybrid_document_title(); ?>
    </title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome-ie7.css" type="text/css" media="all" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php 
		$GetSupremeThemeOptions = get_option('supreme_theme_settings');
		$GetFaviconIcon = $GetSupremeThemeOptions['supreme_favicon_icon'];
		if($GetFaviconIcon!=""){
	 ?>
			<link rel="shortcut icon" type="image/png" href="<?php echo $GetFaviconIcon; ?>">
	<?php 
		}
	?>
    
	<?php wp_head(); // wp_head ?>
   	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.tools.min.js"></script>

    <?php 
		$anchor_theme_settings = get_option('supreme_theme_settings');
		if ( isset($anchor_theme_settings['customcss']) && $anchor_theme_settings['customcss']==1 ) { ?>
			<link href="<?php echo get_stylesheet_directory_uri(); ?>/custom.css" rel="stylesheet" type="text/css" />
	<?php } ?>
	</head>

	<body class="<?php hybrid_body_class(); ?>">
<?php do_atomic( 'open_body' ); // supreme_open_body ?>
<div class="header_bg1">
        <div id="header" class="clearfix">

        <?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
        <?php do_atomic( 'before_header' ); // supreme_before_header ?>
        <?php do_atomic( 'open_header' ); // supreme_open_header ?>
        <div class="header-wrap">
                <div id="branding">
			<?php if ( hybrid_get_setting( 'supreme_logo_url' ) ) : ?>
			<h1 id="site-title"> <a href="<?php echo home_url(); ?>/" title="<?php echo bloginfo( 'name' ); ?>" rel="Home"> <img class="logo" src="<?php echo hybrid_get_setting( 'supreme_logo_url' ); ?>" alt="<?php echo bloginfo( 'name' ); ?>" /> </a> </h1>
			<?php else : ?>
			<?php hybrid_site_title(); ?>
			<?php endif; ?>
			<?php if ( !hybrid_get_setting( 'supreme_site_description' ) )  : // If hide description setting is un-checked, display the site description. ?>
			<?php hybrid_site_description(); ?>
			<?php endif; ?>
		</div> <!-- #branding -->
		
		<!-- Header Right Widget -->
		<div class="header_right">
			<div class="widget header_featured_event">
				<?php dynamic_sidebar( 'header_right' ); // CUSTOM CODE: HIOWEB 12.19.13 show header right widget ?>
			</div>
		</div>
		<!-- Header Right Widget -->
                
                <?php if ( is_active_sidebar( 'header' ) ) : ?>
	                <?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
                <?php endif; ?>
                <?php do_atomic( 'header' ); // supreme_header ?>
            </div>
        <!-- .wrap -->
        
        <?php do_atomic( 'close_header' ); // supreme_close_header ?>
    </div>
        <!-- #header -->
	<?php

			if ( current_theme_supports( 'theme-layouts' ) ) {
				if(function_exists('theme_layouts_get_layout')){
				$supreme_layout = theme_layouts_get_layout(); 
				}else{
				$supreme_layout = 'layout-default';
				}
							
				if ( $supreme_layout == 'layout-default' || $supreme_layout == 'layout-1c' || $supreme_layout == 'layout-2c-l' || $supreme_layout == 'layout-2c-r') {
					$theme_name = wp_get_theme();					
					$nav_menu = get_option('theme_mods_'.strtolower($theme_name));
					
					if($nav_menu['nav_menu_locations']['secondary'] != 0){
						
						get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template.
					}elseif(is_active_sidebar('mega_menu')){
						if(function_exists('dynamic_sidebar')){
							dynamic_sidebar('mega_menu');
						}
						
					}
				}

			}
		?>
			<?php 
			remove_action('pre_get_posts', 'custom_post_author_archive');
			remove_action('pre_get_posts', 'home_page_feature_listing');
			get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
        
    		<?php do_atomic( 'before_header' ); // supreme_before_header ?>
			
	<div class="clearfix"></div>
		<!-- #header -->
		<?php do_atomic( 'after_header' ); // supreme_after_header ?>
    </div>
    
	<?php do_atomic( 'after_menu_primary' ); // supreme_before_header ?>
	<?php 
		if(is_home()):
			dynamic_sidebar( 'homepage-silder' ); // Loads the Home page sidebar.
		?>
		<div id="sidebar-after-header-2c" class="sidebar sidebar-2c sidebar-after-header">
		    <div style="position: relative; height: 78px;" class="sidebar-wrap masonry">
				<?php dynamic_sidebar( 'after_header' ); // Loads the Home page sidebar.	?>
	    	</div>
		</div>
	<?php endif; ?>
	
<?php do_atomic( 'after_menu_primary' ); // supreme_before_header ?>
<div id="container">
<div class="container-wrap">
	<?php do_atomic( 'before_main' ); // supreme_before_main ?>
<div id="main">
<div class="wrap">
<?php do_atomic( 'open_main' ); // supreme_open_main ?>
