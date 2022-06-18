<div class="social-wrap social-wrap-blog widget text-center text-md-left">
    <h4 class="mb-4"><?php the_field( 'title' ); ?></h4>
    <?php if ( have_rows( 'social_media' ) ) : ?>
    <ul class="social social-circle list-unstyled d-flex justify-content-md-start justify-content-lg-between justify-content-center">
        <?php while ( have_rows( 'social_media' ) ) : the_row(); ?>
        <li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank"><span class="icon-<?php the_sub_field( 'icon' ); ?>"></span></a></li>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>
</div>