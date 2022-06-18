<?php
/**
 *
 * Form Center Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'form-center-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-form-center';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="widget form-widget">
        <h4><?php the_field( 'form_title' ); ?></h4>
        <div class="form-text"><?php the_field( 'form_text' ); ?></div>
        <?php $form_select = get_field( 'form_select' ); ?>
        <?php if ( $form_select ) : ?>
                <?php $formID = $form_select['id']; ?>
                <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
        <?php endif; ?>
     </div>
</section>