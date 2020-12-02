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
              'images' => get_images_from_acf_gallery('gallery'),
              'thumb' => has_post_thumbnail() ? [ 'src' => get_the_post_thumbnail_url(), 'alt' => get_the_post_thumbnail_caption(), 'title' => get_the_post_thumbnail_caption()] : []
          ];

          ?>

          <header>
              <div class="mt-4">
                  <?php if(count($post_data['thumb'])) { ?>
                      <img src="<?= $post_data['thumb']['src'] ?>" alt="<?= $post_data['thumb']['alt'] ?>" title="<?= $post_data['thumb']['title'] ?>" class="w-100 carousel-image">
                  <?php } ?>
              </div>
          </header>
          <div id="post_content" class="container-fluid mt-5">
              <div class="row">
                 <div class="col-12 col-md-5 col-lg-4">
                     <h1 class="post_title"><?php the_title() ?></h1>
                     <div class="card-subtitle text-left mt-3"><?= $post_data['subtitle'] ?></div>

                     <div class="mt-5">
                         <?php if(count($post_data['staff']) < 3) { ?>
                             <div class="row">
                             <?php foreach ($post_data['staff'] as $item) { ?>
                                 <div class="mb-4 col-6">
                                     <p class="post_label text-center mb-2"><?= $item['profession'] ?></p>
                                     <?php if(count($item['people'])) {
                                         foreach ($item['people'] as $person) { ?>
                                             <p class="post_value text-center mb-0"><?= $person['name'] ?></p>
                                         <?php }
                                     } ?>
                                 </div>
                             <?php    } ?>
                             </div>
                          <?php } ?>
                     </div>

                 </div>
                  <div class="col-12 col-md-7 col-lg-8 content">
                      <div class="post_content">
                          <?php the_content() ?>
                      </div>

                      <?php if(count($post_data['staff']) == 3) { ?>
                          <div class="row mt-5">
                              <?php foreach ($post_data['staff'] as $item) { ?>
                                  <div class="mb-4 col-4">
                                      <p class="post_label text-center mb-2"><?= $item['profession'] ?></p>
                                      <?php if(count($item['people'])) {
                                          foreach ($item['people'] as $person) { ?>
                                              <p class="post_value text-center mb-0"><?= $person['name'] ?></p>
                                          <?php }
                                      } ?>
                                  </div>
                              <?php    } ?>
                          </div>
                      <?php } ?>

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

              <?php if(count($post_data['images'])) { ?>
              <div class="row mt-4">
                  <?php foreach ($post_data['images'] as $key => $image) { ?>
                  <div id="post_image_<?= $key+1 ?>" class="col-12 my-2 post-image-section">
                      <img src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" title="<?= $image['title'] ?>" class="w-100 post-image">
                  </div>
                  <?php } ?>
              </div>
              <?php } ?>
          </div>

      <?php } ?>

  </article>
  <?php } ?>
