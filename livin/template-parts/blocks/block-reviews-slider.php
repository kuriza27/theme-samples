<?php
$id = 'review-slider' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'review-slider-section-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="review-slider-section position-relative text-center <?php echo esc_attr( $classes ); ?>">
    <div class="container-fluid">
        <div class="row">
        <div class="col animate-children">
            <h3 class="mb-3"><?php the_field( 'heading' ); ?></h3>
            <div class="review-slider js-review-slider">
            <?php if ( have_rows( 'reviews' ) ) : ?>
                <?php while ( have_rows( 'reviews' ) ) : the_row(); ?>
                <div class="sl">
                    <div class="review-box">
                        <p>
                            “<?php the_sub_field( 'text' ); ?>”
                        </p>
                        <div class="stars">
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
</section>