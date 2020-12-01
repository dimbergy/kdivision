<?php

$args = [
    'post_type' => ['general'],
    'post_status' => ['publish'],
    'cat' => 'social',
];

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    $query->the_post();
}
$data = get_field('social_media');

if(count($data)) { ?>
<ul class="nav justify-content-end navbar-social">
    <?php foreach ($data as $social) { ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= $social['link'] ?>" target="_blank">
            <img src="<?= $social['icon']['sizes']['thumbnail'] ?>" alt="<?= $social['icon']['alt'] ?>" title="<?= $social['icon']['title'] ?>" class="social-icon">
        </a>
    </li>
        <?php } ?>
</ul>
<?php } ?>