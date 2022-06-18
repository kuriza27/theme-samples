<?php
/**
 * Block template file: C:\wamp64\www\NODA\livinwp/wp-content/themes/livin/template-parts/blocks/block-grey-centered-content.php
 *
 * Greybg Centered Content Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'greybg-centered-content-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-greybg-centered-content-block';
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
    <div class="container animate-children">
    <span class="title-selected in-text"><?php the_field( 'tag_title' ); ?></span>
        <?php the_field( 'content' ); ?>
        <?php if ( have_rows( 'button' ) ) : ?>
		<?php while ( have_rows( 'button' ) ) : the_row(); ?>
			<?php $button_link = get_sub_field( 'button_link' ); ?>
			<?php if ( $button_link ) : ?>
				<a href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>" class="btn-primary unstyled"><?php echo esc_html( $button_link['title'] ); ?></a>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
        <div class="content-w-60 margin-0-auto"><?php the_field( 'bottom_content' ); ?></div>
    </div>
</section>