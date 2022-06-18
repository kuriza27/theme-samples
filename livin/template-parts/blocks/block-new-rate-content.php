<?php
/**
 * Block template file: C:\wamp64\www\NODA\livinwp/wp-content/themes/livin/template-parts/blocks/block-new-rate-content.php
 *
 * New Rate Content Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'new-rate-content-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-new-rate-content';
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
    <div class="container mobile-container">
        <div class="row">
            <div class="col-md-6 mobile-content-area">
                <div class="mobile-d-flex">
                    <span class="title-selected in-text"><?php the_field( 'tag_title' ); ?></span><span class="tag-w-img"></span><br>
                </div>
                <h2><?php the_field( 'heading' ); ?></h2><br>
                <?php the_field( 'main_content' ); ?>
            </div>
            <div class="col-md-6 d-xs-none d-lg-block">
                <?php $image_on_the_right = get_field( 'image_on_the_right' ); ?>
                <?php $size = 'full'; ?>
                <?php if ( $image_on_the_right ) : ?>
                    <?php echo wp_get_attachment_image( $image_on_the_right, $size ); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if ( get_field( 'enable_package_content' ) == 1 ) : ?>
        <div class="new-rate-area">
            <div class="text-center">
                <span class="title-selected in-text"><?php the_field( 'tag_title_center' ); ?></span><br>
                <h2 class="w-100"><?php the_field( 'heading_title_center' ); ?></h2><br>
            </div>
        </div>
    </div>
            <div class="row new-box-area">
                <div class="col-md-4 new-box-1">
                    <h4><?php the_field( 'subtitle1' ); ?></h4>
                    <h2><?php the_field( 'main_heading1' ); ?></h2>
                    <div class="new-box-content"><?php the_field( 'content1' ); ?></div>
                </div>
                <div class="col-md-4 new-box-2">
                    <h4><?php the_field( 'subtitle2' ); ?></h4>
                    <h2><?php the_field( 'main_heading2' ); ?></h2>
                    <div class="new-box-content"> <?php the_field( 'content2' ); ?>  </div> 
                </div>
                <div class="col-md-4 new-box-3">
                    <h4><?php the_field( 'subtitle3' ); ?></h4>
                    <h2><?php the_field( 'main_heading3' ); ?></h2>
                    <div class="new-box-content"><?php the_field( 'content3' ); ?></div>
                </div>
            </div>
        
        <?php endif; ?>
   
</section>