<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'section-form-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'section-form-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="py-5 <?php echo esc_attr( $classes ); ?>">
    <?php
        $container_width = get_field( 'container_width' );

        if( $container_width == 'fluid' ) {
            $container = '-fluid';
        } elseif( $container_width == 'sm' ) {
            $container = '-sm';
        } else {
            $container = '';
        }
    ?>
    <div class="container<?php echo $container ?>">
        <div class="row justify-content-<?php the_field( 'column_alignment' ); ?>">
            <div class="col-lg-<?php the_field( 'column_width' ); ?>">
                <div class="form--content-block <?php the_field( 'content_custom_class' ); ?>">
                    <?php the_field( 'content' ); ?>
                </div>
                <div class="form--form-block <?php the_field( 'form_custom_class' ); ?>">
                    <?php $form = get_field( 'form' ); ?>
                    <?php if ( $form ) : ?>
                        <?php gravity_form( $form, false, false, null, true, 1, true ); ?>
                    <?php endif; ?>                    
                </div>
            </div>
        </div>
    </div>
</section>