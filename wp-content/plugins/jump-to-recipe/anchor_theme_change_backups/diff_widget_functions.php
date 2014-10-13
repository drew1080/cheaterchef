

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
          							$post_images = bdw_get_images_anchor($post->ID,'post-by-category');
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
         //HioWeb change Feb 18th to use WP thumbnail
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


