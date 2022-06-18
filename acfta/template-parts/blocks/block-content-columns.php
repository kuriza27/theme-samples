<?php
/**
 *
 * Block Content Columns Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-content-columns-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-block-content-columns';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> py-40 mobile-space" style="background-color: <?php the_field( 'background_color' ); ?>;">
<?php $column = get_field( 'column_number' ); ?>
    <div class="container">
        <div class="row justify-content-center justify-content-lg-start content-list-squared page-content-area">
            <?php if( $column == 1 ): ?>
            <div class="col-12">
                <div class="column-content-wrap">
                    <?php the_field( 'column_1_1' ); ?>
                </div>
            </div>
            <?php elseif( $column == 2 ): ?>
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_1_2' ); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="column-content-wrap">
                    <?php the_field( 'column_2_2' ); ?>
                </div>
            </div>
            <?php elseif( $column == 3 ): ?>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_1_3' ); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_2_3' ); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="column-content-wrap">
                    <?php the_field( 'column_3_3' ); ?>
                </div>
            </div>
            <?php elseif( $column == 4 ): ?>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_1_4' ); ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_2_4' ); ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <div class="column-content-wrap">
                    <?php the_field( 'column_3_4' ); ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="column-content-wrap">
                    <?php the_field( 'column_4_4' ); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="col">
                <div class="column-content-wrap">
                    <?php the_field( 'column_1_1' ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>