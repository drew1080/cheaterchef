<?php responsive_widgets(); // responsive above widgets hook ?>

<?php if (!dynamic_sidebar('home-feature-post')) : ?>
<div id="cheater-featured-post" class="widget-wrapper">

  <div class="widget-title-home"><h3><?php _e('Home Feature Post', 'responsive'); ?></h3></div>
  <div class="textwidget"><?php _e('This is your third home widget box. To edit please go to Appearance > Widgets and choose 8th widget from the top in area eight called Home Feature Post. Title is also manageable from widgets as well.','responsive'); ?></div>

</div><!-- end of .widget-wrapper -->
<?php endif; //end of home-feature-post ?>

<?php responsive_widgets_end(); // after widgets hook ?>