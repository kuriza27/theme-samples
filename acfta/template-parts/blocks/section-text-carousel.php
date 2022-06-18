<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-related-search.php
 *
 * Section Text Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'section-text-carousel-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-section-text-carousel';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<?php if ( get_field( 'disable_slider' ) == 1 ) : ?>
<section class="py-80 related-search-containers <?php echo esc_attr( $classes ); ?>">
        <?php if ( have_rows( 'text_carousel' ) ) : ?>
                <?php while ( have_rows( 'text_carousel' ) ) : the_row(); ?>
                <div class="container">
                    <div class="row">
                    <h2 class="mb-4 mobile-space"><?php the_sub_field( 'heading_title' ); ?></h2>
                        <?php if ( have_rows( 'carousel_content' ) ) : ?>
                            <?php while ( have_rows( 'carousel_content' ) ) : the_row(); ?>
                                <div class="col-md-4">
                                    <?php if ( get_sub_field( 'has_title_link' ) == 1 ) : ?>
                                        <?php $title_link = get_sub_field( 'title_link' ); ?>
                                        <a href="<?php echo esc_url( $title_link['url'] ); ?>" target="<?php echo esc_attr( $title_link['target'] ); ?>"><h6><?php the_sub_field( 'title' ); ?></h6></a>
                                    <?php else : ?>
                                        <h6><?php the_sub_field( 'title' ); ?></h6>
                                    <?php endif; ?>
                                        <?php the_sub_field( 'content' ); ?>
                                </div>
                                
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div><!--/row--->
                </div>
                <?php endwhile; ?>
        <?php endif; ?>
</section>
<?php else : ?>
<section class="py-80 <?php echo esc_attr( $classes ); ?>">
        <?php if ( have_rows( 'text_carousel' ) ) : ?>
                <?php while ( have_rows( 'text_carousel' ) ) : the_row(); ?>
                    <div class="container">
                        <h2 class="mb-4 mobile-space"><?php the_sub_field( 'heading_title' ); ?></h2>
                            <?php if ( have_rows( 'carousel_content' ) ) : ?>
                                <div class="links-slider js-text-slider js-no-slider text-carousel">
                                    <?php while ( have_rows( 'carousel_content' ) ) : the_row(); ?>
                                        <div class="sl">
                                            <?php if ( get_sub_field( 'has_title_link' ) == 1 ) : ?>
                                                <?php $title_link = get_sub_field( 'title_link' ); ?>
                                                <a href="<?php echo esc_url( $title_link['url'] ); ?>" target="<?php echo esc_attr( $title_link['target'] ); ?>"><h6><?php the_sub_field( 'title' ); ?></h6></a>
                                            <?php else : ?>
                                                <h6><?php the_sub_field( 'title' ); ?></h6>
                                            <?php endif; ?>
                                                <?php the_sub_field( 'content' ); ?>
                                        </div>
                                    <?php  endwhile; ?>
                                </div><!-- /linkjs -->
                            <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
</section>
<?php endif; ?>
