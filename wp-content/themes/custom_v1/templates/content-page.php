<div class="container">
    <div class="row ">
        <?php if (has_post_thumbnail()) {
            the_post_thumbnail();
        } ?>
        <h1><?php the_title() ?></h1>
        <div>
            <?php the_content() ?>
        </div>

    </div>
</div>
