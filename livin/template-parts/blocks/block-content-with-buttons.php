<?php
$id = 'impact-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="impact-lasts-section section-padding <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container text-center animate-children">
        <?php if(!empty(get_field( 'title' ))):?>
        <h3 class="h3 text-uppercase">
            <span class="title-selected sec"><?php the_field( 'title' ); ?></span>
        </h3>
        <?php endif; ?>
        <?php if(!empty(get_field( 'heading' ))):?>
            <h2><?php the_field( 'heading' ); ?></h2>
        <?php endif; ?>
        <div class="col-xl-8 offset-xl-2 pt-3">
            <p><?php the_field( 'text' ); ?></p>
        </div>

        <?php if ( have_rows( 'buttons' ) ) : ?>
        <div class="d-flex justify-content-center button-group">        
            <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
            <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary', esc_attr( $id ), ''); ?>
            <?php $c++; endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section><!-- .impact-lasts-section -->