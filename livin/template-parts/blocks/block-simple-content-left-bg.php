<?php
/**
 *
 * Simple Content Left Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'simple-content-left-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-simple-content-left-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$background_image = get_field( 'background_image' ); 
?>

<style type="text/css">
	.block-simple-content-left-block{
        background:url(<?php echo $background_image; ?>) no-repeat;
        background-size: cover;
    }
</style>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <span class="title-selected in-text"> <?php the_field( 'tag_title' ); ?></span>
        <div class="content-w-60"><?php the_field( 'content' ); ?></div>
    </div>
</section>