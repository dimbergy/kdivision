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
            $page_data['team'][$counter]['large'] = get_the_post_thumbnail_url();
            $page_data['team'][$counter]['medium'] = get_the_post_thumbnail_url( get_the_ID(), 'medium_large', NULL );
            $page_data['team'][$counter]['title'] = get_the_post_thumbnail_caption();
            $page_data['team'][$counter]['profession'] = get_the_excerpt();
            $counter++;
        }
    }
}

?>

    <section id="<?= $page_data['post_class'] ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-right"><?= $page_data['title'] ?></h1>
                </div>

                <?php if(count($page_data['team'])) {
                    foreach ($page_data['team'] as $member) { ?>
                        <div class="col-12 col-sm-6 col-lg-4 p-0 overlay_effect overlay_center">
                            <a href="<?= $member['large'] ?>" class="showcase" data-lc-options='{"maxWidth":1600, "maxHeight":800}' data-rel="lightcase:slideshow" data-lc-caption="<?= $member['title'] ?>">
                                <img src="<?= $member['medium'] ?>" alt="<?= $member['title'] ?>" class="card-img mb-2">
                                <div class="card-img-overlay">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $member['title'] ?></h5>
                                        <p class="card-subtitle text-center mt-4"><?= $member['profession'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <?= edit_post_link(); ?>
                        </div>
                    <?php  }
                } ?>
                <div class="col-12 mt-4 content">
                    <?= $page_data['content'] ?>
                </div>
            </div>
        </div>
    </section>

<?php wp_reset_query(); ?>