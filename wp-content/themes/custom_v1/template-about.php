<?php
/**
 * Template Name: About
 */

wp_reset_query();

$page_data = getPage('template-about.php');

edit_post_link();

$args = [
    'post_type' => ['team'],
    'post_status' => ['publish'],
];

$query = new WP_Query( $args );
$counter = 0;

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        if (has_post_thumbnail()) {
            $page_data['team'][$counter]['src'] = get_the_post_thumbnail_url();
            $page_data['team'][$counter]['title'] = get_the_post_thumbnail_caption();
            $counter++;
        }
    }
}

?>

    <section id="<?= $page_data['post_class'] ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-right"><?= $page_data['title'] ?></h1>
                </div>
                <?php if(count($page_data['team'])) {
                    foreach ($page_data['team'] as $member) { ?>
                        <div class="col-12 col-sm-6 col-md-4 p-0 overlay_effect overlay_center">
                            <a href="<?= $member['src'] ?>" class="showcase" data-lc-options='{"maxWidth":1600, "maxHeight":800}' data-rel="lightcase:slideshow" data-lc-caption="<?= $member['title'] ?>">
                                <img src="<?= $member['src'] ?>" alt="<?= $member['title'] ?>" class="card-img mb-2">
                                <div class="card-img-overlay">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $member['title'] ?></h5>
                                    </div>
                                </div>
                            </a>
                            <?= edit_post_link(); ?>
                        </div>
                    <?php  }
                } ?>
                <div class="col-12 mt-2">
                    <?= $page_data['content'] ?>
                </div>
            </div>
        </div>
    </section>

<?php wp_reset_query(); ?>