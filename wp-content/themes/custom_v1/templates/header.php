 <div id="app" class="container">
     <nav class="navbar container-fluid navbar-expand-xxl navbar-dark bg-faded navbar-custom fixed-top bg-white">
       <div class="container-fluid">
         <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                <img class="logo" src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
         </a>
         <button class="navbar-toggler home-toggler" type="button">
             <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/wp-content/uploads/2020/11/toggler-e1606601478987.png" alt="toggler-icon" class="toggle-icon">
         </button>
         <div id="navbarNavDropdown" class="navbar navbar-sidebar">
             <div class="container-fluid d-flex flex-column justify-content-center align-items-end navbar-sidebar-container navbar-section">
                 <div class="white_bg"></div>
             <?php

             wp_nav_menu([
               'menu'            => 'k-division',
               'theme_location'  => 'Primary Menu',
               'container'       => '',
               'container_id'    => '',
               'container_class' => '',
               'menu_id'         => false,
               'menu_class'      => 'navbar-nav nav-icons',
               'depth'           => 2,
               'fallback_cb'     => 'bs4navwalker::fallback',
               'walker'          => new bs4navwalker()
             ]); ?>
             <ul class="navbar-nav">
				  <li class="nav-item">
                   <?php pll_the_languages(array('show_flags'=>1,'show_names'=>0, 'hide_current'=>1 ));?>
                 </li>

             </ul>

                 <?php get_template_part('templates/unit', 'social'); ?>

         </div>
         </div>
         </div>
     </nav>
 </div>