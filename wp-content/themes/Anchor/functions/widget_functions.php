<?php
/* Register widgetized areas */
if ( function_exists('register_sidebar') )
{
	
	register_sidebars(1,array('name' => 'Homepage silder','id' => 'homepage-silder','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Header Search','id' => 'header_search','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Header Right','id' => 'secondary_navigation_right','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'After Header','id' => 'after_header','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Homepage Content Area','id' => 'home_content_area','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Footer Area Wide','id' => 'footer-one','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Footer 1','id' => 'footer-second','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Footer 2','id' => 'footer-third','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Footer 3','id' => 'footer-fourth','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
	register_sidebars(1,array('name' => 'Footer 4','id' => 'footer-fifth','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
}

/* Unregister sidebar */
function templ_remove_widgetareas(){
unregister_sidebar( 'secondary_navigation_right-2' );
	unregister_sidebar( 'after-content' );
	unregister_sidebar( 'after-header' );
	unregister_sidebar( 'subsidiary-3c' );
	unregister_sidebar( 'subsidiary-4c' );
	unregister_sidebar( 'subsidiary-5c' );
	unregister_sidebar( 'after-header-2c' );
	unregister_sidebar( 'after-header-3c' );
	unregister_sidebar( 'after-header-4c' );
	unregister_sidebar( 'widgets-template' );
	unregister_sidebar( 'after-header-5c' );
	unregister_sidebar( 'secondary' );
	unregister_sidebar( 'before-content' );
	unregister_sidebar( 'after-singular' );
	unregister_sidebar( 'entry' );
	unregister_sidebar( 'header' );
	unregister_widget('templatic_slider');
	unregister_widget('supreme_popular_post');
	unregister_widget('templatic_recent_post');
}
add_action( 'widgets_init', 'templ_remove_widgetareas',11);

/* Anchor Slider WIDGET STARTS ======================================================================================*/

class anchor_slider extends WP_Widget {
	function anchor_slider() {
	//Constructor
		$widget_ops = array('classname' => 'widget anchor slider', 'description' => 'Use in: Homepage Slider' );
		$this->WP_Widget('anchor_slider', 'T &rarr; Home Slider', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
		$category_slug = empty($instance['category_slug']) ? '' : apply_filters('widget_category_slug', $instance['category_slug']);
		$number_posts = empty($instance['number_posts']) ? '5' : apply_filters('widget_number_posts', $instance['number_posts']);
		$slider_speed = empty($instance['slider_speed']) ? '5000' : apply_filters('widget_slider_speed', $instance['slider_speed']);
		
		if(is_plugin_active('wpml-translation-management/plugin.php'))
		{
			$category_ID =  get_term_by( 'slug',$category_slug, 'category' );	
			$category_slug=$category_ID->slug;
			$title=ucfirst($category_ID->name);
		}
	?>
	<!-- FlexSlider pieces -->

	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/flexslider.css" type="text/css" media="screen" />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>


	<!-- Hook up the FlexSlider -->
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider({
				slideshowSpeed: '<?php echo $slider_speed; ?>'								 
			});
		});
	</script>
    <?php
	if($category_slug != ""):
		$category_slug = explode(",",$category_slug);
		$args=array(
			  'post_type' => 'post',
			  'posts_per_page' => $number_posts,												  
			  'post_status' => 'publish' ,
			  'tax_query' => array(
				array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $category_slug
				))
			  );
	else:
		$args=array(
			  'post_type' => 'post',
			  'posts_per_page' => $number_posts,												  
			  'post_status' => 'publish' ,
			  );
	endif;
	$silder_post = null;
	$silder_post = new WP_Query($args);	
	?>
    <div class="flexslider">
        <ul class="slides">
        	<?php while ($silder_post->have_posts()) : $silder_post->the_post(); ?>
            <li>
            	 <?php
					global $post;
					$post_images = bdw_get_images_anchor($post->ID,'home-page-slider');
					$post_images = $post_images[0]['file'];
				 ?>
                 <?php if($post_images != ""):?>
	                 <img src="<?php echo $post_images; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                 <?php else: ?>
	                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slide_noimage.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                 <?php endif; ?>    
                <div class="flex-caption">
                    <div class="slide_content">
                     <span>
						<?php 
							$cat_name = array();
							foreach(get_the_category($post->ID) as $_category):
									$cat_name[] = $_category->cat_name;
							endforeach;
							echo implode(",",$cat_name);
						?>
                     </span>
                        <h4><a href="<?php the_permalink(); ?>">
							<?php
								if(strlen(get_the_title($post->ID)) > 30)
								 {
									echo substr(get_the_title($post->ID),0,30)."...";
                                 }
                                else
                                 {
                                 	echo get_the_title($post->ID);
                                 }
                             ?>    
                             </a>        
                        </h4>
                        <hr>
                        <p><?php echo anchor_excerpt(20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="button readmore"><?php _e('READ MORE',T_DOMAIN); ?></a>
                     </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
    </div>
   <?php
  	echo $after_widget;
  	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['category_slug'] = strip_tags($new_instance['category_slug']);
		$instance['number_posts'] = strip_tags($new_instance['number_posts']);
		$instance['slider_speed'] = strip_tags($new_instance['slider_speed']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'number_posts' => '','category_slug'=>'','slider_speed'=>''));
		$category_slug = strip_tags($instance['category_slug']);
		$number_posts = strip_tags($instance['number_posts']);
		$slider_speed = strip_tags($instance['slider_speed']);

?>
<p>
  <label for="<?php echo $this->get_field_id('category_slug'); ?>"><?php _e('Category Slug',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('category_slug'); ?>" name="<?php echo $this->get_field_name('category_slug'); ?>" type="text" value="<?php echo esc_attr($category_slug); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('number_posts'); ?>"><?php _e('Number Of Posts',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('number_posts'); ?>" name="<?php echo $this->get_field_name('number_posts'); ?>" type="text" value="<?php echo esc_attr($number_posts); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('slider_speed'); ?>"><?php _e('Slider Speed',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('slider_speed'); ?>" name="<?php echo $this->get_field_name('slider_speed'); ?>" type="text" value="<?php echo esc_attr($slider_speed); ?>" />
  </label>
</p>

<?php
	}
}

register_widget('anchor_slider');

/* Anchor Slider WIDGET ENDS */


/* Text and button WIDGET STARTS ======================================================================================*/

class text_button extends WP_Widget {
	function text_button() {
	//Constructor
		$widget_ops = array('classname' => 'text_button', 'description' => 'Display some text with a big "call to action" button, Use in: Subsidiary');
		$this->WP_Widget('text_button', 'T &rarr; Text and Button widget', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
		$text = empty($instance['text']) ? '' : apply_filters('widget_text', $instance['text']);
		$button_text = empty($instance['button_text']) ? '' : apply_filters('widget_button_text', $instance['button_text']);
		$button_url = empty($instance['button_url']) ? '' : apply_filters('widget_button_url', $instance['button_url']);
	?>
	  <div class="signup_widget">
          <div class="quote">
            <p><?php echo sprintf(__('%s',T_DOMAIN), $text);?></p>
            <a class="signup button" href="<?php echo $button_url; ?>"><?php echo sprintf(__('%s',T_DOMAIN), $button_text); ?></a>
          </div>
	  </div>    
   <?php
  	echo $after_widget;
  	}

	function update($new_instance, $old_instance) {
	//save the widget		
		return $new_instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'text' => '','button_text'=>''));
		$text = $instance['text'];
		$button_text = strip_tags($instance['button_text']);
		$button_url = strip_tags($instance['button_url']);

?>
<p>
  <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text',T_DOMAIN); ?>:
    <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo $text; ?></textarea>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" value="<?php echo esc_attr($button_text); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button Url',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" value="<?php echo esc_attr($button_url); ?>" />
  </label>
</p>


<?php
	}
}

register_widget('text_button');

/* Text and button WIDGET ENDS */

/*
 * Create the templatic recent post widget
 */
	
class anchor_recent_post extends WP_Widget {
	function anchor_recent_post() {
	//Constructor
		$widget_ops = array('classname' => 'widget Anchor Listing Post', 'description' => __('Shows your posts on the homepage, Use in: Homepage Content area',T_DOMAIN) );
		$this->WP_Widget('anchor_recent_post', __('T &rarr; Listing Post',T_DOMAIN), $widget_ops);
	}
	function widget($args, $instance) {
		// prints the widget
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$category_slug = '';
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$category_slug = empty($instance['category_slug']) ? '' : apply_filters('widget_category_slug', $instance['category_slug']);
		$order = empty($instance['order']) ? '' : apply_filters('widget_order', $instance['order']);
		
		global $wpdb,$wp_query,$post;
		
		if(is_plugin_active('wpml-translation-management/plugin.php'))
		{
			$category_ID =  get_term_by( 'slug',$category_slug, 'category' );	
			$category_slug=$category_ID->slug;
			$title=ucfirst($category_ID->name);
		}
		$page_id = $post->ID;
		if(isset($_REQUEST['paged']))
		{
			$paged = $_REQUEST['paged'];
		}
		else
		{
			$paged = anchor_get_url_var('page');
		}
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$args = array();
		if($category_slug != ""):
			$category_slug = explode(",",$category_slug);
			$args=array(
				  'post_type' => 'post',
				  'posts_per_page' => $posts_per_page,
				  'paged'=>$paged,
				  'post_status' => 'publish',
				  'tax_query' => array(
					array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $category_slug
					)),
				  'order' => $order
				  );
		else:
			$args=array(
				  'post_type' => 'post',
				  'posts_per_page' => $posts_per_page,
				  'paged'=>$paged,
				  'post_status' => 'publish',
				  'order' => $order
				  );
		endif;
		$listing_post = null;
		$listing_post = new WP_Query($args);
		$wp_query = $listing_post;
	?>
        <div class="loop-meta">
            <h3 class="loop-title"><?php echo sprintf(__('%s',T_DOMAIN), $title);?></h3>
        </div>
		<ul class="blog-listing">
			 <?php while ($listing_post->have_posts()) : $listing_post->the_post(); ?>
				 <?php
                    $post_images = bdw_get_images_anchor($post->ID,'thumbnail');
                    $post_images = $post_images[0]['file'];
                 ?>
                <li class="blog-listing">
                 <a class="post-image" href="<?php the_permalink(); ?>">
                 	<?php if($post_images != ""):?>
                    	<img src="<?php echo $post_images; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                    <?php else: ?>
                    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/list_noimage.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                    <?php endif; ?>
                 </a>
                    <span class="top_line"><span class="category">
  						<?php
							$cat_name = '';
							foreach(get_the_category($post->ID) as $_category):
									$cat_name = $_category->cat_name;
									$catId = $_category->term_id;
									break;
							endforeach;
						?>
                     	<a rel="tag" href="<?php echo get_category_link($catId); ?>"><?php echo $cat_name; ?></a>
                    </span>
                    <a class="comment-count" href="<?php the_permalink(); ?>"><?php $comcount = wp_count_comments( $post->ID ); echo $comcount->total_comments; ?></a> </span>
                    <h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <a href="<?php the_permalink(); ?>" class="moretag"><?php _e('Read more',T_DOMAIN); ?> &#187; </a>
                </li>
             <?php endwhile; ?>   
        </ul>
        <?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template.  
			wp_reset_query();
		?>        
	<?php
    	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		//save the widget				
		return $new_instance;
		//return $instance;
	}

	function form($instance) {

		//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','category_slug'=>'','order'=>''));
		$title = strip_tags($instance['title']);
		$category_slug = strip_tags($instance['category_slug']);
		$order = strip_tags($instance['order']);

	?>
	<p>
	  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',T_DOMAIN);?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	  </label>
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id('category_slug'); ?>"><?php _e('Category Slug:',T_DOMAIN);?>
		  <input class="widefat" id="<?php echo $this->get_field_id('category_slug'); ?>" name="<?php echo $this->get_field_name('category_slug'); ?>" type="text" value="<?php echo $instance['category_slug']; ?>" />
	  </label>
	</p>	
    
    <p>
    	<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Sort Order', T_DOMAIN); ?>:</label>
        <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
            <option style="padding-right:10px;" value="DESC" <?php selected('DESC', $instance['order']); ?>><?php _e('Descending (3, 2, 1)', T_DOMAIN); ?></option>
            <option style="padding-right:10px;" value="ASC" <?php selected('ASC', $instance['order']); ?>><?php _e('Ascending (1, 2, 3)', T_DOMAIN); ?></option>
        </select>
    </p>
	<?php
	}
}
/*
 * templatic recent post widget init
 */
register_widget("anchor_recent_post");



/* Post By Category WIDGET STARTS ======================================================================================*/

class post_by_category extends WP_Widget {
	function post_by_category() {
	//Constructor
		$widget_ops = array('classname' => '', 'description' => 'Display a single post from a specific category, Use in: Subsidiary ' );
		$this->WP_Widget('post_by_category', 'T &rarr; Post By Category', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$category_slug = empty($instance['category_slug']) ? '1' : apply_filters('widget_category_slug', $instance['category_slug']);
	?>
	<?php
		if(isset($title) && $title!=""){ ?>
    <h3><?php echo sprintf(__('%s',T_DOMAIN), $title); ?></h3>
			<?php } ?>	
    <ul class="blog-listing">
			<?php
			$exp_slug = explode(",",$category_slug);
			foreach($exp_slug as $_exp_slug):
					$args = array();
					if(is_plugin_active('wpml-translation-management/plugin.php'))
						{
							$category_ID = get_term_by( 'slug',$_exp_slug, 'category' );	
							$_exp_slug = $category_ID->slug;
							$title = ucfirst($category_ID->name);
						}
					$args=array(
						  'post_type' => 'post',
						  'posts_per_page' => -1,												  
						  'post_status' => 'publish',
						  'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $_exp_slug
							)
						   ),
						  'order' => 'DESC');
					$category_post = null;
					$category_post = new WP_Query($args);
          //HioWeb change Feb 18th to show 3 posts
					$counter = 0;
          					?>
          					<?php while ($category_post->have_posts() && $counter < 3) : $category_post->the_post(); ?>
          					<li class="blog-listing">
          						 <?php
          							global $post;
                        //HioWeb change Feb 18th to show thumbnails
          							$post_images = bdw_get_images_anchor($post->ID,'thumbnail');
          							$post_images = $post_images[0]['file'];
          						 ?>
          						 <a class="post-image" href="<?php the_permalink(); ?>">
          							 <?php if($post_images != ""):?>
          								 <img src="<?php echo $post_images; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
          							 <?php else: ?>
          								 <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/list_noimage.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
          							 <?php endif; ?>
          						 </a>
          							<?php 
          								$cat_name = array();
          								foreach(get_the_category($post->ID) as $_category):
          								  if ($_category->cat_name != "Featured Home Static") {
          								    $cat_name[] = $_category->cat_name;
          								  }
          								endforeach;
          							?>
          						 <span class="category"><a rel="tag"><?php echo implode(",",$cat_name); ?></a></span>
          						 <h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          						 <p><?php _e(anchor_excerpt(15)); ?></p>
          						 <a href="<?php the_permalink(); ?>" class="moretag"> <?php _e('Read more',T_DOMAIN); ?> &#187; </a>
          					</li>
          				<?php $counter++; endwhile; ?>
           <?php endforeach; ?>     
    </ul>
   <?php
  	echo $after_widget;
  	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category_slug'] = strip_tags($new_instance['category_slug']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','category_slug'=>''));
		$title = strip_tags($instance['title']);
		$category_slug = strip_tags($instance['category_slug']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('category_slug'); ?>"><?php _e('Category Slug',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('category_slug'); ?>" name="<?php echo $this->get_field_name('category_slug'); ?>" type="text" value="<?php echo esc_attr($category_slug); ?>" />
  </label>
</p>
<p><i><?php _e('Slugs should be in comma saperator.',T_DOMAIN); ?></i></p>
<?php
	}
}

register_widget('post_by_category');

/* Post By category WIDGET ENDS */


/* Anchor Tabber WIDGET STARTS ======================================================================================*/

class anchor_tabber extends WP_Widget {
	function anchor_tabber() {
	//Constructor
		$widget_ops = array('classname' => 'Widget Anchor Tabber', 'description' => 'Display tabs with icons and descriptions, Use in: Subsidiary ' );
		$this->WP_Widget('anchor_tabber', 'T &rarr; Anchor Tabber', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title_text = empty($instance['title_text']) ? '' : apply_filters('widget_title_text', $instance['title_text']);
		$content_area = empty($instance['content_area']) ? '' : apply_filters('widget_content_area', $instance['content_area']);
		$img_url = empty($instance['img_url']) ? '' : apply_filters('widget_img_url', $instance['img_url']);
		$tabber_class = array("subscptn","notes","coldsrvcs","nastyicon","subscptn","notes","coldsrvcs","nastyicon");
	?>
		<script type="text/javascript">
            jQuery(function() {
            // setup ul.tabs to work as tabs for each div directly under div.panes
            jQuery("ul.tabs").tabs("div.panes > div");
            });
        </script>

  	  <div class="description_widget_tabs">
          <ul class="tabs">
              <?php $i = 0; foreach($title_text as $_title_text): ?>
                    <li class="<?php echo $tabber_class[$i]; ?>"><a href="#">
						<img src="<?php echo $img_url[$i]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
						<?php echo sprintf(__('%s',T_DOMAIN), $_title_text); ?>
                        </a>
                    </li>
              <?php $i++; endforeach; ?>
          </ul>
          <div class="panes">
            <?php $i=0; foreach($content_area as $_content_area): ?>
                <div>
                  <h3><?php  echo sprintf(__('%s',T_DOMAIN), $title_text[$i]); ?></h3>
                 <?php echo sprintf(__('%s',T_DOMAIN), $_content_area); ?>
                </div>
            <?php $i++; endforeach; ?>
          </div>
	</div>
    
   <?php
  	echo $after_widget;
  	}

	function update($new_instance, $old_instance) {
	//save the widget
		return $new_instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title_text' => '','content_area'=>''));
		$title_text = ($instance['title_text']);
		$content_area = ($instance['content_area']);
		$img_url = ($instance['img_url']);

?>
<div id="TabberGroup" class="TabberGroup">
    <div id="BoxDiv_id" class="BoxDiv-1">
        <?php 
			global $textbox_name,$textarea_name;
			$textbox_name = $this->get_field_name('title_text');
			$textarea_name = $this->get_field_name('content_area');
			$img_url_name = $this->get_field_name('img_url');
		?>
        <p>
          <label for="<?php echo $this->get_field_id('title_text'); ?>"><?php _e('Title',T_DOMAIN); ?>:
            <input class="widefat" name="<?php echo $this->get_field_name('title_text'); ?>[]" type="text" value="<?php echo esc_attr($title_text[0]); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('content_area'); ?>"><?php _e('Content',T_DOMAIN); ?>:</label><br/>
          <textarea name="<?php echo $this->get_field_name('content_area'); ?>[]" cols="35" rows="6"><?php echo esc_attr($content_area[0]); ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('img_url'); ?>"><?php _e('Image Url',T_DOMAIN); ?>:
            <input class="widefat" name="<?php echo $this->get_field_name('img_url'); ?>[]" type="text" value="<?php echo esc_attr($img_url[0]); ?>" />
            <i><?php _e('Image size should be in 16x16',T_DOMAIN); ?></i>
          </label>
        </p>
	</div>
        <?php
		for($i=1;$i<count($title_text);$i++)
			{
				if($title_text[$i]!="")
				{
					$j=$i+1;
					echo '<div class="BoxDiv-'.$j.'" id="BoxDiv-'.$j.'">';
					echo '<p>';
					echo '<label>Title '.$j.'</label>';
					echo ' <input type="text" class="widefat"  name="'.$textbox_name.'[]" value="'.esc_attr($title_text[$i]).'">';
					echo '</p>';
					echo '<p>';
					echo '<label>Content '.$j.'</label>';
					echo ' <textarea type="text" class="widefat"  name="'.$textarea_name.'[]" >'.esc_attr($content_area[$i]).'</textarea>';
					echo '</p>';
					echo '<p>';
					echo '<label>Image Url '.$j.'</label>';
					echo ' <input type="text" class="widefat"  name="'.$img_url_name.'[]" value="'.esc_attr($img_url[$i]).'">';
					echo '</p>';
					echo '</div>';
				}
			}		
		?>
        
</div>
<p>
  <input value="<?php _e('Add One',T_DOMAIN); ?>" id="addButton" class="addButton" type="button" onclick="add_box('<?php echo $textbox_name;?>','<?php echo $textarea_name;?>','<?php echo $img_url_name; ?>');"/>
  <input value="<?php _e('Remove One',T_DOMAIN); ?>" id="removeButton" class="removeButton" type="button" onclick="remove_box();" />
</p>

<?php
	}
}

register_widget('anchor_tabber');
add_action('admin_footer','multitext_box_widget');

function multitext_box_widget()
{
	global $textbox_name,$textarea_name;
	?>
      <script type="application/javascript">
	    
		function add_box(name,text_area,img_url)
		{
			var i = 0;
			var array_id = new Array();
			jQuery("#TabberGroup Div").each(function(){
				 array_id[i] = this.id;
				 i++;
			});
			var newTextBox = jQuery(document.createElement('div')).attr("class", 'BoxDiv-' + i);
			var newTextBoxDiv = newTextBox.attr("id", 'BoxDiv-' + i);
			newTextBoxDiv.html('<p><label><?php _e('Title',T_DOMAIN); ?> : </label>'+'<input type="text" class="widefat" name="'+name+'[]" id="textbox' + counter + '" value="" ></p><p><label><?php _e('Content',T_DOMAIN); ?> : </label>'+'<textarea class="widefat" name="'+text_area+'[]" id="textarea' + counter + '" ></textarea></p><p><label><?php _e('Image Url',T_DOMAIN); ?> : </label>'+'<input type="text" class="widefat" name="'+img_url+'[]" id="textbox' + counter + '" value="" ></p>');			  
			newTextBoxDiv.appendTo(".TabberGroup");
				
		    counter++;
		}
		function remove_box()
		{
		    var i = 0;
			jQuery("#TabberGroup Div").each(function(){
				 last_id = this.id;
				 i++;
			});
			if(i-1==1){
			   alert("you need one textbox and textarea required.");
			   return false;
		    }
		    jQuery("."+last_id).remove();
		}
	</script>
     <?php
}
/* Anchor Tabber WIDGET ENDS */


/* Location WIDGET STARTS ======================================================================================*/

class location extends WP_Widget {
	function location() {
	//Constructor
		$widget_ops = array('classname' => 'widget anchor slider', 'description' => 'Display a location in your header, Use in: Header Right' );
		$this->WP_Widget('location', 'T &rarr; Location', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$address = empty($instance['address']) ? '' : apply_filters('widget_address', $instance['address']);
	?>
        <a target="_blank" href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $address;?>" class="location" >
            <h3><?php echo sprintf(__('%s',T_DOMAIN), $title); ?></h3>
            <span><?php _e('View Directions',T_DOMAIN); ?></span>
        </a>
   <?php
  	echo $after_widget;
  	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'address' => '','title'=>''));
		$title = strip_tags($instance['title']);
		$address = strip_tags($instance['address']);

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title',T_DOMAIN); ?>:
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address',T_DOMAIN); ?>:<br/>
  	<textarea name="<?php echo $this->get_field_name('address'); ?>" id="<?php echo $this->get_field_id('address'); ?>" cols="35" ><?php echo esc_attr($address); ?></textarea>
  </label>
</p>

<?php
	}
}

register_widget('location');

/* Location WIDGET ENDS */


// =============================== Feedburner Rssfeed widget ======================================

class rssfeed extends WP_Widget {
	function rssfeed() {
	//Constructor
		$widget_ops = array('classname' => 'widget Rss Feed', 'description' => apply_filters('templ_rssfeed_widget_desc_filter',__('Rss Feed Widget',T_DOMAIN)) );		
		$this->WP_Widget('widget_rssfeed', apply_filters('templ_rssfeed_widget_title_filter',__('T &rarr; Rss Feed',T_DOMAIN)), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$id = empty($instance['id']) ? '' : apply_filters('widget_id', $instance['id']);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$text = empty($instance['text']) ? '' : apply_filters('widget_text', $instance['text']);
?>
    	<div class="widget clearfix" >
        <div class="newsletter">
            <h3> 
             <?php if($title){?><span class="title"><?php echo sprintf(__('%s',T_DOMAIN), $title);?></span> <?php }?> 
              </h3>
            <?php if ( $text <> "" ) { ?>	 
                 <a target="_blank" href="<?php if($id){echo 'http://feeds2.feedburner.com/'.$id;}else{bloginfo('rss_url');} ?>" ><?php echo sprintf(__('%s',T_DOMAIN), $text);?></a>
            <?php } ?>
  			</div>
		  </div>  <!-- #end -->
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['title'] = ($new_instance['title']);
		$instance['text'] = ($new_instance['text']);		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','id' => '' ) );		
		$id = strip_tags($instance['id']);
		$title = strip_tags($instance['title']);
		$text = strip_tags($instance['text']);
 ?>
 <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:',T_DOMAIN);?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
 <p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Feedburner ID (ex :- templatic):',T_DOMAIN);?> <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Short Description:',T_DOMAIN);?> <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_attr($text); ?></textarea></label></p>
<?php
	}}
	
register_widget('rssfeed');
?>