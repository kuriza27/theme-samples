
<?php
$id = 'simple-section-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="simple-section <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container">
        <div class="row animate-children">
            <div class="col-12">
                <h3><?php the_field( 'heading' ); ?></h3>
            </div>
            <div class="col-lg-10">
                <p><?php the_field( 'content' ); ?></p>
                <div class="d-flex button-group flex-wrap flex-md-nowrap">
                    <?php if ( have_rows( 'buttons' ) ) : ?>
                        <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-secondary', esc_attr( $id ), ''); ?>
                        <?php $c++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>