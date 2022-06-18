<?php
$id = 'gallery-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'insta-section-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="insta-section primary-bg animate-children <?php echo esc_attr( $classes ); ?>">
    <div class="insta-slider js-insta-slider">
        <?php $gallery_ids = get_field( 'gallery' ); ?>
        <?php $size = '177x177'; ?>
        <?php if ( $gallery_ids ) :  ?>
            <?php foreach ( $gallery_ids as $gallery_id ): ?>
            <div class="sl">
                <?php echo wp_get_attachment_image( $gallery_id, $size ); ?>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>