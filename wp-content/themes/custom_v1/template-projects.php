<?php
/**
* Template Name: Projects
*/

wp_reset_query();

$page_data = getPage('template-projects.php');
$page_data['categories'] = get_terms_by_post_type('projects');

edit_post_link();

$args = [
'post_type' => ['projects'],
'post_status' => ['publish'],
];

$query = new WP_Query( $args );

$counter = 0;

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        if (has_post_thumbnail()) {
            $page_data['projects'][$counter]['image_src'] = get_the_post_thumbnail_url();
            $page_data['projects'][$counter]['image_title'] = get_the_post_thumbnail_caption();
            $page_data['projects'][$counter]['permalink'] = get_the_permalink();
            $page_data['projects'][$counter]['columns'] = get_field('columns');
            $page_data['projects'][$counter]['order'] = get_field('order');
            $page_data['projects'][$counter]['title'] = get_the_title();
            $page_data['projects'][$counter]['caption'] = get_field('caption');
            $page_data['projects'][$counter]['categories'] = get_the_category();
            $counter++;
        }
    }
}

function cmp($a, $b)
{
    if ($a['order'] == $b['order'])
    {
        return 0;
    }
    return ($a['order'] < $a['order']) ? -1 : 1;
}

usort($page_data['projects'], "cmp");

?>

<section id="<?= $page_data['post_class'] ?>">
    <div class="container-fluid">
        <div class="row">
            <?php if(count($page_data['categories'])) { ?>
                <div class="col-12 col-md-6 d-flex align-self-end">
                    <ul class="nav filter_nav">
                        <?php foreach ($page_data['categories'] as $category) { ?>
                            <li class="nav-item">
                                <a class="pl-0 nav-link" href="javascript:;" data-filter=".<?= $category['slug'] ?>"><?= $category['name'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <div class="col-12 col-md-6">
                <h1 class="text-right"><?= $page_data['title'] ?></h1>
            </div>
        </div>



        <div class="grid mt-3 row">
            <?php if(count($page_data['projects'])) {
                foreach ($page_data['projects'] as $project) {
                    $categories = [];
                    if(count($project['categories'])) {
                        foreach ($project['categories'] as $key => $category) {
                            $categories[] = $category->category_nicename;
                        }
                    }
                    $filters = implode(' ', $categories); ?>

                        <div class="col-12 p-0 grid-item <?= $project['columns']==2 ? 'col-sm-12 col-md-8 col-xl-6' : 'col-sm-6 col-md-4 col-xl-3' ?> <?= $filters ?>">
                            <a href="<?= $project['permalink']?>" class="perma_link">
                            <div class="card overlay_effect">
                                <img src="<?= $project['image_src'] ?>" alt="<?= $project['image_title'] ?>" class="card-img-top">
                                <div class="card-img-overlay">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $project['title'] ?></h5>
                                        <p class="card-text"><?= $project['caption'] ?></p>

                                    </div>
                                </div>
                            </div>
                            </a>
                            <div>
                                <?= edit_post_link(); ?>
                            </div>
                        </div>
                <?php }
            } ?>
        </div>
    </div>
</section>

<?php wp_reset_query(); ?>