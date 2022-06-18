<?php
/**
 *
 * School Participant Logos Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'school-participant-logos-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-school-participant-logos';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php if ( get_field( 'enable_border_bottom' ) == 1 ) : ?>border-bottom<?php endif?>">
    <div class="container">
    <?php if(get_field('title')) { ?> 
        <span class="title-selected in-text"><p><?php the_field( 'title' ); ?></p></span><br>
        <?php } ?>
        <?php if ( have_rows( 'logos' ) ) : ?>
            <div class="block-school-participant-logos__wrapper js-school-logos">
            <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                <?php $image = get_sub_field( 'image' ); ?>
                <?php $size = 'full'; ?>
                <?php if ( $image ) : ?>
                    <div class="block-school-participant-logos__wrapper--item"><?php echo wp_get_attachment_image( $image, $size ); ?></div>
                <?php endif; ?>
                <?php the_sub_field( 'url' ); ?>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>