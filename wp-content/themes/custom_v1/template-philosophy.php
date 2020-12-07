<?php
/**
 * Template Name: Philosophy
 */


wp_reset_query();

$page_data = getPage('template-philosophy.php');
$page_data['keywords_label'] = get_field('label');
$page_data['keywords_content'] = get_field('keywords');

edit_post_link();

?>

<section id="<?= $page_data['post_class'] ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-right"><?= $page_data['title'] ?></h1>
            </div>
            <?php if (has_post_thumbnail()) { ?>
                <div class="col-12 col-lg-5">
                        <img src="<?= $page_data['image_medium_large'] ?>" alt="<?= $page_data['image_title'] ?>" class="w-100 philosophy-cover">
                </div>
            <?php } ?>
            <div class="col-12 col-lg-7 content mt-4 mt-lg-0">
                <?= $page_data['content'] ?>
            </div><div class="col-12 mt-5">
                <h5 class="label"><?= $page_data['keywords_label'] ?></h5>
                <p class="tags"><?= $page_data['keywords_content'] ?></p>
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query(); ?>