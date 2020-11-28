<?php
/**
 * Template Name: Home
 */


wp_reset_query();

$page_data = getPage('template-home.php');
$page_data['logo_top'] = get_field('logo_top');
$page_data['logo_bottom'] = get_field('logo_bottom');

edit_post_link();

?>

    <section id="<?= $page_data['post_class'] ?>">
        <div class="container">
            <div class="row">

                <div class="col-16 mx-auto k-division-logo">
                    <div class="hovered_div position-relative">
                        <div class="black_line"></div>
                        <div class="white_line"></div>
                        <?php if(count($page_data['logo_top'])) { ?>
                            <img src="<?= $page_data['logo_top']['url'] ?>" alt="<?= $page_data['logo_top']['name'] ?>" class="position-absolute img_top">
                        <?php } ?>
                        <?php if(count($page_data['logo_bottom'])) { ?>
                            <img src="<?= $page_data['logo_bottom']['url'] ?>" alt="<?= $page_data['logo_bottom']['name'] ?>" class="img_btm">
                        <?php } ?>
                    </div>

                </div>
                <?php if (has_post_thumbnail()) { ?>
                    <div class="col-12 position-absolute" style="opacity: 0">
                        <a href="<?= $page_data['image_src'] ?>" class="showcase" data-lc-options='{"maxWidth":1600, "maxHeight":800}' data-rel="lightcase" data-lc-caption="<?= $page_data['image_title'] ?>">
                            <img src="<?= $page_data['image_src'] ?>" alt="<?= $page_data['image_title'] ?>" class="w-100">
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

<?php wp_reset_query(); ?>