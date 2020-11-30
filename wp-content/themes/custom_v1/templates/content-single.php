<?php while (have_posts()) { the_post(); ?>
  <article <?php post_class(); ?>>
      <?php
      $args = array(
        'post_type'              => array( get_post_type() ),
        'post_status'            => array( 'publish' ),
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() || (get_post_type() == 'projects') ) {

          $post_data = [
              'subtitle' => get_field('subtitle'),
              'staff' => get_field('staff'),
              'images' => get_images_from_acf_gallery('gallery')
          ];

           if ( has_post_thumbnail() ) {
              $thumb = [
                  'src' => get_the_post_thumbnail_url(),
                  'alt' => get_the_post_thumbnail_caption(),
                  'title' => get_the_post_thumbnail_caption()
              ];

              array_push($post_data['images'], $thumb);
          }

          $images = array_reverse($post_data['images']); ?>


          <header>
              <div class="mt-4">
                  <?php if(count($images)) { ?>
                  <div id="postCarousel" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                          <?php foreach ($images as $key => $image) { ?>
                              <li data-target="#postCarousel" data-slide-to="<?= $key ?>" class="<?= $key==0 ? 'active' : '' ?>"></li>
                          <?php } ?>
                      </ol>
                      <div class="carousel-inner">
                          <?php foreach ($images as $key => $image) { ?>
                          <div class="carousel-item<?= $key==0 ? ' active' : '' ?>">
                              <a href="<?= $image['src'] ?>" class="showcase" data-lc-options='{"maxWidth":1600, "maxHeight":800}' data-rel="lightcase:slideshow" data-lc-caption="<?= $image['title'] ?>">
                              <img class="d-block w-100 carousel-image" src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" title="<?= $image['title'] ?>">
                              </a>
                          </div>
                          <?php } ?>
                      </div>
                  </div>
                  <?php } ?>
              </div>
          </header>
          <div class="container-fluid mt-5">
              <div class="row">
                 <div class="col-12 col-md-5 col-lg-4">
                     <h1 class="post_title"><?php the_title() ?></h1>
                     <div class="card-subtitle text-left mt-3"><?= $post_data['subtitle'] ?></div>

                     <div class="mt-5">
                         <?php if(count($post_data['staff']) < 4) {
                             foreach ($post_data['staff'] as $item) { ?>
                                 <div class="mb-4">
                                     <p class="post_label text-left mb-2"><?= $item['profession'] ?></p>
                                     <?php if(count($item['people'])) {
                                         foreach ($item['people'] as $person) { ?>
                                             <p class="post_value text-left mb-0"><?= $person['name'] ?></p>
                                         <?php }
                                     } ?>
                                 </div>
                             <?php    }
                          } ?>
                     </div>

                 </div>
                  <div class="col-12 col-md-7 col-lg-8 content">
                      <div class="post_content">
                          <?php the_content() ?>
                      </div>
                  </div>
              </div>

              <?php if(count($post_data['staff']) > 3) { ?>
              <div class="row justify-content-between mt-4">
                  <?php foreach ($post_data['staff'] as $item) { ?>
                  <div class="col-auto mb-4">
                      <p class="post_label text-center mb-2"><?= $item['profession'] ?></p>
                      <?php if(count($item['people'])) {
                          foreach ($item['people'] as $person) { ?>
                              <p class="post_value text-center mb-0"><?= $person['name'] ?></p>
                          <?php }
                      } ?>
                  </div>
                  <?php } ?>
              </div>
              <?php } ?>
          </div>

      <?php } ?>

  </article>
  <?php } ?>
