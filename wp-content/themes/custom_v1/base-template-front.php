<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?> data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->


	  
	  
	      <?php $loop = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1 ) ); ?>
    <?php
  //  $postNumber = 1;
    while ( $loop->have_posts() ) : $loop->the_post(); ?>


      <div id="<?php the_ID() ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="<?php the_ID() ?>" aria-hidden="true" style="margin-top:150px">

        <div class="modal-dialog modal-lg modal-team" role="document">
          <div class="modal-content p-3">
            <div class="modal-header">
				<div class="col-md-2 modal-thumb">
              <?php the_post_thumbnail() ?>
            </div>
				<div class="col-md-8">
              <h5 class="modal-title" id="<?php the_ID() ?>"><?php the_title()?><span style="font-style: italic; font-size: 1rem"><?php the_excerpt() ?></span></h5>
				</div>
				
				<div class="col-md-2">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
				</div>
            </div>
            <div class="modal-body">
              <?php the_content() ?>
            </div>
          </div>
        </div>

      </div>


    <?php endwhile; wp_reset_query();?>

	  
	  
	  
	  
        <main class="main p-0">

          <?php
            do_action('get_header');
            get_template_part('templates/header');
          ?>
          <?php include Wrapper\template_path(); ?>
          <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>

        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
