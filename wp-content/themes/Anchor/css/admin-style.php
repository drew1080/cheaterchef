<?php ob_start();
	$file = dirname(__FILE__);
	$file = substr($file,0,stripos($file, "wp-content"));
	require($file . "/wp-load.php");
	global $wpdb;
	if(function_exists('hybrid_get_setting')){
		$color1 = hybrid_get_setting( 'color_picker_color1' );
		$color2 = hybrid_get_setting( 'color_picker_color2' );
		$color3 = hybrid_get_setting( 'color_picker_color3' );
		$color4 = hybrid_get_setting( 'color_picker_color4' );
		$color5 = hybrid_get_setting( 'color_picker_color5' );
	}else{
		$supreme_theme_settings = get_option('supreme_theme_settings');
		$color1 = $supreme_theme_settings[ 'color_picker_color1' ];
		$color2 = $supreme_theme_settings[ 'color_picker_color2' ];
		$color3 = $supreme_theme_settings[ 'color_picker_color3' ];
		$color4 = $supreme_theme_settings[ 'color_picker_color4' ];
		$color5 = $supreme_theme_settings[ 'color_picker_color5' ];
	}


// Change color of Body Background

if($color1 != "#" || $color1 != ""){?>
    
	body,
	div#sidebar-subsidiary,
	div#sidebar-subsidiary-2c,
	div#menu-secondary .menu li a:hover, div#menu-secondary .menu li.current-menu-item a, div#menu-secondary .menu li.current_page_item a, div#menu-subsidiary .menu li a:hover, div#menu-subsidiary .menu li.current-menu-item a, div#menu-subsidiary .menu li.current_page_item a, div.mega-menu ul.mega li a:hover, div.mega-menu ul.mega li.current-menu-item a, div.mega-menu ul.mega li.current-page-item a, div#menu-secondary .menu li li a, div#menu-subsidiary .menu li li a, .pagination .current, .comment-pagination .current, .bbp-pagination .current, .loop-nav span.previous, .loop-nav span.next, .pagination .page-numbers, .comment-pagination .page-numbers, .bbp-pagination .page-numbers {
    	background-color: <?php echo $color1;?>;
				}
	.flex-caption .slide_content span {
		color: <?php echo $color1;?>;
	}
    
<?php }





// Change color of Header and Footer

if($color2 != "#" || $color2 != ""){?>

	.header_bg1,
    .footer,
    
    .sidebar ul.eventlist,
    
    #sidebar-primary .newsletter, .events_detail_sidebar .newsletter,
				#sidebar-primary .subscribe, .events_detail_sidebar .subscribe,
    
    .blog-listing li span.top_line .category a {
    	background-color: <?php echo $color2;?>;
        }
        
        
    input[type="date"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="email"], 
    input[type="month"], 
    input[type="number"], 
    input[type="password"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="text"], 
    input.input-text, input[type="time"], 
    input[type="url"], input[type="week"], 
    select, 
    textarea,
    
    .loop-nav span.previous, .loop-nav span.next, .pagination .page-numbers, .comment-pagination .page-numbers, .bbp-pagination .page-numbers {
    	border-color: <?php echo $color2;?>;
    }

<?php }






// Change color of Navigation, Buttons, Headings, Titles and Pagination
if($color3 != "#" || $color3 != ""){?>

	button,
    .button,
    input[type="reset"],
    input[type="submit"],
    input[type="button"],
    #sidebar-subsidiary a.moretag,
    a.rss_btn:hover,
    a.play_btn:hover,
    .comment-reply-link:hover,
    .comment-reply-login:hover,
    .social_media ul li a,
    .blog-listing li span.top_line a.comment-count,
    div.flex-caption,
    body .flex-control-nav a:hover,
    body .flex-control-nav a.flex-active,
    body div.product form.cart .button:hover, body #content div.product form.cart .button:hover,
    body a.button.alt:hover, body button.button.alt:hover, body input.button.alt:hover, body #respond input#submit.alt:hover, body #content input.button.alt:hover,
    .comment-reply-link, .comment-reply-login {
    	background-color: <?php echo $color3;?>;
    }
    
    
    #sidebar-primary h3, 
    #sidebar-secondary h3, 
    .events_detail_sidebar h3,
				#sidebar-after-header-2c h3,
    
    div#menu-secondary .menu li a:hover, 
    div#menu-secondary .menu li.current-menu-item a, 
    div#menu-secondary .menu li.current_page_item a, 
    div#menu-subsidiary .menu li a:hover, 
    div#menu-subsidiary .menu li.current-menu-item a, 
    div#menu-subsidiary .menu li.current_page_item a, 
    div.mega-menu ul.mega li a:hover, 
    div.mega-menu ul.mega li.current-menu-item a, 
    div.mega-menu ul.mega li.current-page-item a,
    
    .pagination .current, .comment-pagination .current, .bbp-pagination .current,
    
    .blog-listing a.moretag,
    
    .eventlist li .content span.title a:hover,
    
    .eventlist li .content span.title b,
    
    #sidebar-subsidiary .description_widget_tabs ul.tabs li a.current,
    
    #sidebar-subsidiary-2c #testimonials span cite,
    
    #sidebar-subsidiary-2c .widget ul li a,
    
    .footer_widget ul li a:hover,
    
    #footer .footer-content p > a,
    
    .footer_widget h3, .footer h3,
    
    .header-wrap .header_featured_event a:hover,
    
    .widget #wp-calendar td a,
    
    .widget ul li a:hover,
    
    .entry-title a:hover,
    
    #content ul.products li.product .price,
    
    ins span.amount, .amount,
    
    #content ul.products li.product:hover h3,
    
    #breadcrumb a:hover, .breadcrumb a:hover, .bbp-breadcrumb a:hover,
    
    body .addresses a.edit,
    
    .arclist ul li a,
    
    .eventlist li .content span.view_event a,
    
    .sidebar ul.categories li a {
    	color: <?php echo $color3;?>;
    }
    
    body div.product .product-summary span.price, body div.product .product-summary p.price, body #content div.product .product-summary span.price, body #content div.product .product-summary p.price,
    
    body .flex-caption .slide_content .readmore {
    	color: <?php echo $color3;?> !important;
    }
    
    div#menu-secondary .menu li a:hover, 
    div#menu-secondary .menu li.current-menu-item a, 
    div#menu-secondary .menu li.current_page_item a, 
    div#menu-subsidiary .menu li a:hover, 
    div#menu-subsidiary .menu li.current-menu-item a, 
    div#menu-subsidiary .menu li.current_page_item a, 
    div.mega-menu ul.mega li a:hover, 
    div.mega-menu ul.mega li.current-menu-item a, 
    div.mega-menu ul.mega li.current-page-item a,
    
    .sidebar ul.eventlist li .content span.date {
    	border-top-color: <?php echo $color3;?>;
    }
    
    .blog-listing li a.post-image img,
    
    .eventlist li a img {
    	border-bottom-color: <?php echo $color3;?>;
    }
    
    .pagination .current, .comment-pagination .current, .bbp-pagination .current,
    .loop-nav span.previous:hover, .loop-nav span.next:hover, .pagination .page-numbers:hover, .comment-pagination .page-numbers:hover, .bbp-pagination .page-numbers:hover,
    
    input[type="date"]:focus, 
    input[type="datetime"]:focus, 
    input[type="datetime-local"]:focus, 
    input[type="email"]:focus, 
    input[type="month"]:focus, 
    input[type="number"]:focus, 
    input[type="password"]:focus, 
    input[type="search"]:focus, 
    input[type="tel"]:focus, 
    input[type="text"]:focus, 
    input.input-text:focus, 
    input[type="time"]:focus, 
    input[type="url"]:focus,
    input[type="week"]:focus, 
    select:focus, 
    textarea:focus {
    	border-color: <?php echo $color3;?>;
        }


<?php }



// Change color of Button Hover
if($color4 != "#" || $color4 != ""){?>

	button:hover,
    .button:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    input[type="button"]:hover,
				.social_media ul li a:hover,
    #sidebar-subsidiary a.moretag:hover,
    .flex-caption .slide_content .readmore:hover,
    a.rss_btn,
    a.play_btn,
    .comment-reply-link,
    .comment-reply-login,
    
    body .cart .button:hover, body .cart input.button:hover, 
    body .cart-collaterals .shipping_calculator .button:hover, 
    body a.button:hover, body button.button:hover, 
    body input.button:hover, 
    body #respond input#submit:hover, 
    body #content input.button:hover, 
    #searchform input[type="submit"]:hover,
    
    body div.product form.cart .button, 
    body #content div.product form.cart .button,
    
    body .quantity .plus:hover, body .quantity .minus:hover, body #content .quantity .plus:hover, body #content .quantity .minus:hover,
    
    body a.button.alt, body button.button.alt, body input.button.alt, body #respond input#submit.alt, body #content input.button.alt {
    	background-color: <?php echo $color4;?>;
    }

<?php }


//Change color of Content text, Input text

if($color5 != "#" || $color5 != ""){?>

	body,
    
    a,
    #site-title a,
    #site-description,
    .header-wrap .header_featured_event h3,
    div#menu-secondary .menu li a, div#menu-subsidiary .menu li a, div.mega-menu ul.mega li a,
    .header_search_wrap input.search-text, .mega-menu input.search-text,
    .flex-control-nav a,
    .flex-caption .slide_content span,
    #sidebar-after-header-2c .widget h3,
    
    input[type="date"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="email"], 
    input[type="month"], 
    input[type="number"], 
    input[type="password"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="text"], 
    input.input-text, input[type="time"], 
    input[type="url"], input[type="week"], 
    select, 
    textarea,
    
    .entry-title a,
    .taxable_area .textwidget,
    .footer_widget ul li a,
    .blog-listing a.moretag:hover,
     .widget h3,
     #sidebar-subsidiary-2c .widget h3,
     .copyright,
     #content h3,
     form,
     .comment-author cite,
     .comment-meta .published, .comment-meta a,
     .comment-text,
     .entry-meta,
     .arclist ul li,
     #breadcrumb, .breadcrumb, .bbp-breadcrumb,
     #breadcrumb a, .breadcrumb a, .bbp-breadcrumb a,
     #content .entry-title,
     .arclist ul li span.arclist_comment,
     .arclist ul li a:hover,
     .widget #wp-calendar caption,
     #sidebar-primary .widget .newsletter a, .events_detail_sidebar .widget .newsletter a,
     #sidebar-primary .widget .newsletter h3, #sidebar-primary .subscribe h3, .events_detail_sidebar .widget .newsletter h3, .events_detail_sidebar .subscribe h3, .subscribe_cont h3,
     .eventlist li .content span.date,
     .eventlist li .content span.date b,
     del span.amount,
     #content h1,
     .loop-nav span.previous, .loop-nav span.next, .pagination .page-numbers, .comment-pagination .page-numbers, .bbp-pagination .page-numbers,
     .eventlist li .content span.postedby,
     body div.product .woocommerce_tabs ul.tabs li.active a, body #content div.product .woocommerce_tabs ul.tabs li.active a,
     #content ul.products li.product .price .from, #content ul.products li.product .price del,
     #sidebar-subsidiary-2c .widget ul li a:hover,
					#sidebar-primary .subscribe p, .events_detail_sidebar .subscribe p,
					#footer .footer-content p > a:hover,
					.sidebar ul.categories li a:hover,
					input[type="date"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input.input-text:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, select:focus, textarea:focus, div.gform_wrapper input:focus, div.gform_wrapper select:focus, div.gform_wrapper textarea:focus{
    	color: <?php echo $color5;?>;
        }

<?php } ?>





<?php
$color_data = ob_get_contents();
ob_clean();
if(isset($color_data) && $color_data !=''){?>
	<style type="text/css">
		<?php echo $color_data;?>
	</style>
<?php 
}
?>