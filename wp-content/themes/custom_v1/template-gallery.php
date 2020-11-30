<?php
/**
 * Template Name: Gallery
 */

wp_reset_query();

$page_data = getPage('template-gallery.php');
$page_data['images'] = get_field('images');

edit_post_link(); ?>

<section id="<?= $page_data['post_class'] ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-right"><?= $page_data['title'] ?></h1>
            </div>
        </div>
        <div class="grid d-flex flex-wrap mt-3">
            <?php if(count($page_data['images'])) {
                foreach ($page_data['images'] as $data) { ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-0 overlay_effect overlay_center grid-item">
                        <?php if(!empty($data['link']['url'])) { ?>
                        <a href="<?= $data['link']['url'] ?>" target="_blank">
                            <?php } ?>
                        <img src="<?= $data['photo']['sizes']['medium_large'] ?>" alt="<?= $data['photo']['alt'] ?>" title="<?= $data['photo']['alt'] ?>" class="card-img">
                            <div class="card-img-overlay">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data['title'] ?></h5>
                                </div>
                            </div>
                    <?php if(!empty($data['link']['url'])) { ?>
                        </a>
                        <?php } ?>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>

<?php wp_reset_query(); ?>