<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package supreme
 * @subpackage Template
 */

?>
<?php 
global $wp_query,$post;
$post_type = $post->post_type;
/*get flag to check if woocommerce is active or not*/
if(function_exists('check_if_woocommerce_active')){
	$is_woo_active = check_if_woocommerce_active();
}
/*get flag to check if woocommerce is active or not*/
if($is_woo_active == 'true' && $post_type =='product'){
	echo '<div id="sidebar-primary" class="sidebar">';
		dynamic_sidebar( 'woocommerce_sidebar' );
	echo '</div>';
}else{
	get_sidebar( 'primary' ); // Loads the sidebar-primary template. <br />
}
?>
<?php do_atomic( 'close_main' ); // supreme_close_main ?>
</div>
<!-- .wrap -->

</div>
<!-- #main -->

<?php do_atomic( 'after_main' ); // supreme_after_main ?>
</div>
</div>
<!-- #container -->

<?php do_atomic( 'close_body' ); // supreme_close_body ?>
<?php if(is_home()): ?>
<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
<?php get_sidebar( 'subsidiary-2c' ); // Loads the sidebar-subsidiary.php template. ?>
<?php endif; ?>
<?php do_atomic( 'before_footer' ); // supreme_before_footer ?>

<div class="footer clearfix">
<div class="container_12">
<div class="taxable_area">
<?php dynamic_sidebar('footer-one'); ?>
</div>
</div>
<div class="footer_container footer_widget clearfix">
    <div class="column02">
    <?php dynamic_sidebar('footer-second'); ?>
    </div>
    <div class="column02">
    <?php dynamic_sidebar('footer-third'); ?>
    </div>
    <div class="column02">
    <?php dynamic_sidebar('footer-fourth'); ?>
    </div>
    <div class="column02">
    <?php dynamic_sidebar('footer-fifth'); ?>
    </div>
</div>
<div id="footer" class="clearfix">
<?php do_atomic( 'open_footer' ); // supreme_open_footer ?>
<div class="footer-wrap">
<?php get_template_part( 'menu', 'footer' ); // Loads the menu-primary.php template. ?>
<?php
$follow_text = '';
if (function_exists('icl_register_string')) {
	icl_register_string('templatic', 'footer_insert',$follow_text );
	$follow_text = icl_t('templatic', 'footer_insert',$follow_text);
}
?>		

<div class="footer-content">
	<?php $footer_text = apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) );
		  if($follow_text):
			  echo $follow_text = icl_t('templatic', 'footer_insert',$footer_text);
		  else:
		  	  echo $footer_text;	
		  endif;
	?> 
</div>
<!-- .footer-content -->

<?php do_atomic( 'footer' ); // supreme_footer ?>
</div>
<!-- .wrap -->

<?php do_atomic( 'close_footer' ); // supreme_close_footer ?>
</div>
<!-- #footer --> 
</div>
<?php do_atomic( 'after_footer' ); // supreme_after_footer ?>
<?php wp_footer(); // wp_footer ?>
</body></html>