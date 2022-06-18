<?php
/**
 * 
 *
 * Column List Content Layout Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'column-list-content-layout-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-column-list-content-layout-block';
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
        <h2><?php the_field( 'title_heading' ); ?></h2>
        <div class="row">
            <?php if ( have_rows( 'add_column_content' ) ) : ?>
                <?php while ( have_rows( 'add_column_content' ) ) : the_row(); ?>
                   <div class="col-lg-6 column-list-content">
                        <?php $logo = get_sub_field( 'logo' ); ?>
                        <?php $size = '298x212'; ?>
                        <?php if ( $logo ) : ?>
                            <?php $logo_link = get_sub_field( 'logo_link' ); ?>
                            <?php if ( $logo_link ) : ?>
                                <div class="text-center">
                                  <a href="<?php echo esc_url( $logo_link['url'] ); ?>" target="<?php echo esc_attr( $logo_link['target'] ); ?>"><?php echo wp_get_attachment_image( $logo, $size ); ?></a>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                 <?php echo wp_get_attachment_image( $logo, $size ); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <h3 class="text-center"><?php the_sub_field( 'heading' ); ?></h3>
                        <?php the_sub_field( 'content' ); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>