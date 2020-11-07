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
              'location_label' => get_field('location')['label'],
              'location' => get_field('location')['value'],
              'status_label' => get_field('status')['label'],
              'status' => get_field('status')['value'],
              'date' => get_field('date')['value'],
              'details' => get_field('details'),
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


          <header class="mt-5 pt-5">
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
                              <img class="d-block w-100 carousel-image" src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" title="<?= $image['tit;e'] ?>">
                              </a>
                          </div>
                          <?php } ?>
                      </div>
                  </div>
                  <?php } ?>
              </div>
          </header>
          <div class="container mt-5">
              <div class="row">
                 <div class="col-12 col-md-5">
                     <?php $subtitle_secondary = $post_data['location'];
                     if(!empty($post_data['date'])) {
                         $subtitle_secondary .= ', ' . $post_data['date'];
                     }
                     ?>
                     <div class="card-subtitle"><?= $post_data['subtitle'] ? $post_data['subtitle'] : $subtitle_secondary ?></div>
                     <h1 class="post_title"><?php the_title() ?></h1>

                     <div class="mt-5">
                         <?php if(!empty($post_data['location'])) { ?>
                         <div>
                             <span class="post_label"><?= $post_data['location_label'] ?></span>
                             <span class="pl-2 post_value"><?= $post_data['location'] ?></span>
                         </div>
                         <?php } ?>
                         <?php if(!empty($post_data['status'])) { ?>
                             <div>
                                 <span class="post_label"><?= $post_data['status_label'] ?></span>
                                 <span class="pl-2 post_value"><?= $post_data['status'] ?></span>
                             </div>
                         <?php } ?>
                         <?php if(count($post_data['details'])) { ?>
                             <div class="my-4">
                             <?php foreach ($post_data['details'] as $detail) { ?>
                                 <div>
                                     <span class="post_label"><?= $detail['label'] ?></span>
                                     <span class="pl-2 post_value"><?= $detail['value'] ?></span>
                                 </div>
                             <?php } ?>
                             </div>
                         <?php }?>
                     </div>

                 </div>
                  <div class="col-12 col-md-7">
                      <?php the_content() ?>
                  </div>
              </div>
          </div>


      <?php } ?>

  </article>
  <?php } ?>
