<?php
/**
 * Block template file
 *
 * Content List Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-list-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-list-block';
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
        <div class="mobile-content-area">
            <?php the_field( 'main_heading' ); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="content animate-children">
                        <?php the_field( 'content' ); ?><br>
                        <ul>
                        <?php if ( have_rows( 'content_list' ) ) : ?>
                            <?php while ( have_rows( 'content_list' ) ) : the_row(); ?>
                                <li><?php the_sub_field( 'add_content' ); ?></li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 d-none d-lg-block">
                    <div class="content animate-children">
                        <?php $image = get_field( 'image' ); ?>
                        <?php $size = 'full'; ?>
                        <?php if ( $image ) : ?>
                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                        <?php endif; ?>
                        <?php if ( get_field( 'enable_image_foot_note' ) == 1 ) : ?>
                            <div class="img-note">
                                <?php the_field( 'image_note' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-lg-none d-xs-block">
        <?php $image = get_field( 'image' ); ?>
        <?php $size = 'full'; ?>
           <?php if ( $image ) : ?>
                <?php echo wp_get_attachment_image( $image, $size ); ?>
            <?php endif; ?>
            <?php if ( get_field( 'enable_image_foot_note' ) == 1 ) : ?>
            <div class="img-note">
               <?php the_field( 'image_note' ); ?>
             </div>
            <?php endif; ?>
    </div>
</section>