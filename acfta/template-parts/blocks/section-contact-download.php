<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-contact-download.php
 *
 * Contact Download Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-download-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-contact-download';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="cont-downl-section <?php echo esc_attr( $classes ); ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h1><?php the_field( 'contact_heading' ); ?></h1>
                                    <?php the_field( 'box_left_content' ); ?>
                                </div>
                                <div class="col-sm-6">
                                    <h1><?php the_field( 'box_right_heading' ); ?></h1>
                                    <?php the_field( 'box_right_content' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>