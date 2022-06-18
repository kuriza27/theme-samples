<?php
/**
 * Block template file
 *
 * Cta Content Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-content-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-cta-content-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">

	
</style>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> cta-content-block">
    <?php if ( have_rows( 'add_content_with_tag' ) ) : ?>
        <div class="container content-tag-area text-center">
                <?php while ( have_rows( 'add_content_with_tag' ) ) : the_row(); ?>
                    <h2><?php the_sub_field( 'content' ); ?></h2>
                    <?php if(get_sub_field( 'tag_title' )):?>
                    <span class="title-selected in-text"><?php the_sub_field( 'tag_title' ); ?></span>
                    <?php endif; ?>
                    <br><br>
                <?php endwhile; ?>
            <?php $add_image = get_field( 'add_image' ); ?>
            <?php $size = 'full'; ?>
            <?php if ( $add_image ) : ?>
                <?php echo wp_get_attachment_image( $add_image, $size ); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ( get_field( 'enable_cta_content_with_button' ) == 1 ) : ?>
    <div style="background-color:<?php the_field( 'cta_background_color' ); ?>;color:<?php the_field( 'cta_content_text_color' ); ?>;">
        <div class="container content-cta-area text-md-left">        
            <?php the_field( 'cta_content' ); ?>
            <?php if ( have_rows( 'button' ) ) : ?>
                <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                    <?php $button_link = get_sub_field( 'button_link' ); ?>
                    <?php if ( $button_link ) : ?>
                        <a href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>" class="btn btn-primary unstyled"><?php echo esc_html( $button_link['title'] ); ?></a>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</section>