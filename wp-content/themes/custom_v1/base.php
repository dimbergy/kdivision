<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->

	 <?php

     $args = array(
         'posts_per_page'         => 1,
         'post_type'              => array( 'cycles' ),
         'post_status'            => array( 'publish' ),
         'order' 	               => 'DESC',
     );

     // The Query
     $query = new WP_Query( $args );
     $query->the_post();
     $expDate = get_field('exp_date');


	 date_default_timezone_set('Europe/Athens') ;
	  $date_now = date('Y-m-d H:i:s');
//	  $date_exp = date('2018-11-11 23:59:59');
     $date_exp = $expDate;
	  ?>


    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <!--<?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
       <!-- <?php endif; ?>-->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
