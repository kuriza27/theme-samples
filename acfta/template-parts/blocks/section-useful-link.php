<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-useful-link.php
 *
 * Useful Links Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'useful-links-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-useful-links-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="useful-links-section <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2><?php the_field( 'heading' ); ?></h2>
            </div>
        </div>
        <div class="row gutter-22">
            <?php if ( have_rows( 'useful_links' ) ) : ?>
                <?php while ( have_rows( 'useful_links' ) ) : the_row(); ?>
                    <?php $links = get_sub_field( 'links' ); ?>
                    <?php if ( $links ) : ?>
                        <div class="col-lg-3 col-6 d-flex mb-3">
                            <a href="<?php echo esc_url( $links['url'] ); ?>" target="<?php echo esc_attr( $links['target'] ); ?>"><?php echo esc_html( $links['title'] ); ?></a>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
    </div>
</section>