<?php

$id = 'home-banner-carousel-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-home-carousel';
$classes = 'block-home-banner-carousel';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="home-carousel-<?php echo esc_attr( $block['id'] ); ?>" class="img-text-slider-section <?php echo $classes; ?>">
<section id="home-carousel-<?php echo esc_attr( $id ); ?>" class="img-text-slider-section <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="img-text-slider js-header-slider">
            <?php if ( have_rows( 'carousel' ) ) : ?>
                <?php while ( have_rows( 'carousel' ) ) : the_row(); ?>                 
                    <div class="sl position-relative">
                        <div class="img-text-box position-relative">
                            <?php $link = get_sub_field( 'link' ); ?>
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = '1190x787'; ?>
                            <?php if ( $image ) : ?>
                                <a href="<?php echo esc_html( $link ); ?>">
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="sl-text">
                                <?php the_sub_field( 'content' ); ?>
                                <div class="text-right">
                                    <a class="more-link d-inline-flex align-items-center" href="<?php echo esc_html( $link ); ?>">More information <span class="icon-plus-light"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>