<?php
$id = 'target_alt-image-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
if ( get_field( 'image_position' ) == 1 ) {
    $left = 'order-0';
    $right = 'order-1';
}
else {
    $left = 'order-1';
    $right = 'order-0';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="target_alt-image position-relative section-padding rm-display-flex <?php echo esc_attr( $block['className'] ); ?>">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <div class="container">
        <div class="row no-gutters align-items-center animate-children">
            <div class="col-6 <?php echo $left; ?>">
                <div class="half-img-left">
                    <?php $image = get_field( 'image' ); ?>
                    <?php $size = '690x612'; ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-6 <?php echo $right; ?>">
                <div class="half-right-content translate-down-anim pr-0 pr-lg-4" data-speed="0.4">
                    <h3 class="h3">
                        <span class="title-selected sec"><?php the_field( 'title' ); ?></span>
                    </h3>
                    <?php the_field( 'content' ); ?>
                    <?php echo custom_button_styling(get_field( 'button_styling' ), 'btn-'. get_field_object( 'button' )['key'], get_field( 'button' ), get_field( 'enable_custom_button_styling' ), 'btn-primary', esc_attr( $id ), ''); ?>
                </div>
            </div>
        </div>
    </div>
</section>