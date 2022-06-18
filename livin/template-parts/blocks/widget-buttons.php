<div class="widget">
    <h4 class="mb-4"><?php the_field( 'title' ); ?></h4>
    <?php if ( have_rows( 'buttons' ) ) : ?>
    <div class="row gutters-10">
        <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
        <?php $button = get_sub_field( 'button' ); ?>
        <div class="col-12 col-md-3 col-lg-6 d-flex">
            <a class="btn btn-secondary w-100 d-flex align-items-center justify-content-center mb-2" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?></a>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>