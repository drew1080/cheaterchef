<?php

  register_sidebar(array(
      'name' => __('Home Feature Post', 'responsive'),
      'description' => __('Home Feature - home.php', 'responsive'),
      'id' => 'home-feature-post',
      'before_title' => '<div class="widget-title-home"><h3>',
      'after_title' => '</h3></div>',
      'before_widget' => '<div id="cheater-featured-post" class="widget-wrapper %2$s">',
      'after_widget' => '</div>'
  ));
  
  function add_search_box($items, $args) {
  
           ob_start();
           get_search_form();
           $searchform = ob_get_contents();
           ob_end_clean();
  
           $items .= '<li class="search-nav">' . $searchform . '</li>';
  
       return $items;
     }
  
  add_filter('wp_nav_menu_items','add_search_box', 10, 2);
  
  function my_manage_columns( $columns ) {
    unset($columns['analytics']);
    return $columns;
  }

  function my_column_init() {
    add_filter( 'manage_posts_columns' , 'my_manage_columns' );
    add_filter( 'manage_pages_columns' , 'my_manage_columns' );
  }
  
  add_action( 'admin_init' , 'my_column_init' );   
     
?>
