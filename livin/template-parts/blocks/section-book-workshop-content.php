<?php
/**
 *
 * Book Workshop Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'book-workshop-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-book-workshop';
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <span class="title-selected in-text"><?php the_field( 'tag_title' ); ?></span>
                <div class="content-w-80"><h2><?php the_field( 'main_heading' ); ?></h2></div>
                <?php $button = get_field( 'button' ); ?>
                <?php if ( $button ) : ?>
                    <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" class="btn-primary"><?php echo esc_html( $button['title'] ); ?></a>
                <?php endif; ?>
                <div class="text-center d-xs-block d-sm-none d-lg-none">
                    <?php $image = get_field( 'image' ); ?>
                    <?php $size = 'full'; ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size ); ?><br><br>
                    <?php endif; ?>
                </div>
                <div class="content-w-60"><?php the_field( 'content' ); ?></div>
            </div>
            <div class="col-md-6">
                <div class="text-center d-none d-xs-none d-sm-block d-lg-block">
                    <?php $image = get_field( 'image' ); ?>
                    <?php $size = 'full'; ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>