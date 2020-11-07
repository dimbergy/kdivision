<?php
/**
 * Template Name: Gallery
 */

wp_reset_query();

$page_data = getPage('template-gallery.php');
$page_data['images'] = get_images_from_acf_gallery('gallery');

edit_post_link(); ?>

<section id="<?= $page_data['post_class'] ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-right"><?= $page_data['title'] ?></h1>
            </div>

            <?php if(count($page_data['images'])) {
                foreach ($page_data['images'] as $image) { ?>
                    <div class="col-12 col-sm-6 col-md-4 p-0 overlay_effect overlay_center">
                        <a href="<?= $image['src'] ?>" class="showcase" data-lc-options='{"maxWidth":1600, "maxHeight":800}' data-rel="lightcase:slideshow" data-lc-caption="<?= $image['title'] ?>">
                        <img src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" class="card-img">
                            <div class="card-img-overlay">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $image['title'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>

<?php wp_reset_query(); ?>