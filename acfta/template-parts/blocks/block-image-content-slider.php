
<?php
$id = 'block-image-content-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-image-content-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$bg_color = get_field( 'background_color' );

$width = 'col-xl-10';
if( get_field('slider_width') == 'Wide' ) {
    $width = '';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> py-5" style="<?php if( $bg_color ){ echo 'background-color:'. $bg_color; } ?>" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 <?php echo $width; ?>">
                <h2 class="mb-4 mb-lg-5"><?php the_field( 'heading' ); ?></h2>
                
                <?php if ( have_rows( 'slider' ) ) : ?>                
                <div class="js-content-slider image-content-slider--panel">

                    <?php while ( have_rows( 'slider' ) ) : the_row(); ?>
                    <div class="image-content-slider--item">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php $size = '566x566'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size, false, array( 'class' => 'w-100 h-auto' ) ); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <?php the_sub_field( 'content' ); ?>
                                <?php if ( have_rows( 'buttons' ) ) : ?>
                                    <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                                        <?php $button = get_sub_field( 'button' ); ?>
                                        <?php if ( $button ) : ?>
                                            <div class="mt-5"></div>
                                            <a class="btn btn-outline-dark btn-small w-auto text-uppercase align-items-center d-inline-flex" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>

                </div>
                <?php else : ?>
                    <h3 class="text-center">< Add slides here ></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>