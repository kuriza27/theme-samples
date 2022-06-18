<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-home-carousel.php
 *
 * Home Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home-carousel-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-home-carousel';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="leadership-program-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-7 px-0 px-lg-3">
                     <?php $box_left_image = get_field( 'box_left_image' ); ?>
                        <?php $size = 'full'; ?>
                        <?php if ( $box_left_image ) : ?>
                            <?php echo wp_get_attachment_image( $box_left_image, $size ); ?>
                        <?php endif; ?>
            </div>
            <div class="col-lg-6 col-xl-5">
                <div class="leadership-program-box">
                        <div class="leadership-program-body page-content-area">
                            <?php the_field( 'box_content' ); ?>
                            <?php $button_link = get_field( 'button_link' ); ?>
                            <?php if ( $button_link ) : ?>
                                <div class="mx-n30">
                                    <a class="btn btn-black" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <footer class="leadership-program-footer mx-n15">
                        <span class="icon-exclamation-solid"></span>
                        <?php the_field( 'footer_info' ); ?>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>