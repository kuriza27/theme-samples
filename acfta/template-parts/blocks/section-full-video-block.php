<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-full-video-block.php
 *
 * Full Video Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'full-video-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-full-video-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="video-section <?php echo esc_attr( $classes ); ?>">
    <?php $width = get_field( 'container_width' ) == 'sm' ? '-sm' : ''; ?>
    <div class="container<?php echo $width; ?>">
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="text-center text-sm-left"> <?php the_field( 'heading' ); ?> <span class="icon-play-circle"></span></h2>
                <div class="video-wrap">
                    <?php the_field( 'video' ); ?>
                </div>
                <?php $button_link = get_field( 'button_link' ); ?>
                <?php if ( $button_link ) : ?>
                    <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="text-20 mb-4 btn btn--dark mt-4" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
 </section>