<?php
/**
 * Template Name: Contact
 */

wp_reset_query();

$page_data = getPage('template-contact.php');
$page_data['map'] = get_field('map');

edit_post_link(); ?>


<section id="<?= $page_data['post_class'] ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-right"><?= $page_data['title'] ?></h1>
            </div>

           <div class="col-12 col-md-4 text-right contact-details">
               <div class="content">
                   <?= $page_data['content'] ?>
               </div>


               <?php get_template_part('templates/unit', 'social'); ?>

           </div>

            <div class="col-12 col-md-8 mt-4 mt-md-0">
<!--                --><?//= $page_data['map'] ?>

                <img src="http://kdivision.dimitriosvergados.eu/wp-content/uploads/2020/11/map-scaled.jpg" alt="map" class="map">
            </div>
        </div>
    </div>
</section>

<?php wp_reset_query(); ?>

