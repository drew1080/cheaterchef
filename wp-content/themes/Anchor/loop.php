<?php
/**
 * Loop Template
 *
 * Displays the entire post content.
 *
 * @package supreme
 * @subpackage Template
 */
 
?>
        <ul class="loop-entries">
			<?php if ( have_posts() ) : ?>
    
                <?php while ( have_posts() ) : the_post(); ?>
                
                <?php do_atomic( 'before_entry' ); // supreme_before_entry ?>
                
                <li id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
                    <?php do_atomic( 'open_entry' ); // supreme_open_entry ?>
                    
						<?php if ( current_theme_supports( 'get-the-image' ) ) : ?>
                        <?php $image = get_the_image( array( 'echo' => false ) );
                            if ( $image ) : ?>
                                <a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="featured-image-link"><?php get_the_image( array( 'size' => 'supreme-thumbnail', 'link_to_post' => false, 'width' => '240' ) ); ?></a>
                        <?php 
                            else : ?>
                                <a href="<?php echo get_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark" class="featured-image-link">
                                    <img class="thumbnail" src="<?php echo get_stylesheet_directory_uri().'/images/bolg_noimage.jpg'?>" alt="<?php the_title_attribute( 'echo=1' ); ?>" width="240" />
                                </a>	
                        <?php	endif; ?>
                    <?php endif; ?>
                
                    <?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
                    
                    <?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'by [entry-author] on [entry-published] [entry-permalink]', 'supreme' ) . '</div>'); ?>

                    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'supreme' ) ); ?>    
                    <?php do_atomic( 'close_entry' ); // supreme_close_entry ?>
    
                </li><!-- .hentry --><!-- .hentry -->
                
                <?php do_atomic( 'after_entry' ); // supreme_after_entry ?>
                
                    <?php endwhile; ?>
    
                <?php else : ?>
                
					<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>
    
            <?php endif; ?>
        </ul>