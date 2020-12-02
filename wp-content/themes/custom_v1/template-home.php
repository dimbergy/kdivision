<?php
/**
 * Template Name: Home
 */


wp_reset_query();

$page_data = getPage('template-home.php');
$page_data['logo_top'] = get_field('logo_top');
$page_data['logo_bottom'] = get_field('logo_bottom');
$page_data['logo_full'] = get_field('logo_full');
$page_data['banners'] = get_images_from_acf_gallery('slider');

edit_post_link();

?>

    <section id="<?= $page_data['post_class'] ?>">
        <div class="container-fluid">
            <div class="row position-relative">

                <div class="col-16 mx-auto k-division-logo">
                    <div class="hovered_div position-relative">
                        <div class="white_line d-none"></div>
                        <?php if(count($page_data['logo_top'])) { ?>
                            <img src="<?= $page_data['logo_top']['url'] ?>" alt="<?= $page_data['logo_top']['name'] ?>" class="position-absolute img_top">
                        <?php } ?>
                        <?php if(count($page_data['logo_bottom'])) { ?>
                            <img src="<?= $page_data['logo_bottom']['url'] ?>" alt="<?= $page_data['logo_bottom']['name'] ?>" class="position-absolute img_btm">
                        <?php } ?>
                        <?php if(count($page_data['logo_full'])) { ?>
                            <img src="<?= $page_data['logo_full']['url'] ?>" alt="<?= $page_data['logo_full']['name'] ?>" class="img_full">
                        <?php } ?>
                    </div>

                </div>
                <?php if (has_post_thumbnail()) { ?>
                    <div class="col-12 slider_col">

                        <?php if(count($page_data['banners'])) { ?>
                            <div id="homeCarousel" class="carousel slide" data-ride="false">
                                <ol class="carousel-indicators">
                                    <?php foreach ($page_data['banners'] as $key => $image) { ?>
                                        <li data-target="#homeCarousel" data-slide-to="<?= $key ?>" class="<?= $key==0 ? 'active' : '' ?>"></li>
                                    <?php } ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php foreach ($page_data['banners'] as $key => $image) { ?>
                                        <div class="carousel-item<?= $key==0 ? ' active' : '' ?>">
                                                <img class="d-block w-100 carousel-image" src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" title="<?= $image['tit;e'] ?>">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="navbar-custom w-100">
                    <div id="navbarHomeDropdown" class="navbar navbar-sidebar">
                        <div class="container-fluid d-flex flex-column justify-content-center align-items-end navbar-sidebar-container navbar-section">
                            <div class="white_bg"></div>
                            <?php

                            wp_nav_menu([
                                'menu'            => 'k-division',
                                'theme_location'  => 'Primary Menu',
                                'container'       => '',
                                'container_id'    => '',
                                'container_class' => '',
                                'menu_id'         => false,
                                'menu_class'      => 'navbar-nav nav-icons',
                                'depth'           => 2,
                                'fallback_cb'     => 'bs4navwalker::fallback',
                                'walker'          => new bs4navwalker()
                            ]); ?>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <?php pll_the_languages(array('show_flags'=>1,'show_names'=>0, 'hide_current'=>1 ));?>
                                </li>

                            </ul>

                            <?php get_template_part('templates/unit', 'social'); ?>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

<?php wp_reset_query(); ?>