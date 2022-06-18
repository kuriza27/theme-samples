<?php
/**
 *
 * Column Content Options Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'column-content-options-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-column-content-options';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<hr class="m-0">
<section id="<?php echo esc_attr( $id ); ?>" class="py-80 <?php echo esc_attr( $classes ); ?> mobile-space" style="background-color:#F6F6F6;">
    <div class="page-content">
        <?php if ( have_rows( 'single_content' ) ): ?>
            <div class="container-sm">
                <div class="row justify-content-sm-center">
                    <?php while ( have_rows( 'single_content' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'single_content' ) : ?>
                            <div class="col-10  py-40">
                                <div class="text-align-center">
                                <h2><?php the_sub_field( 'heading_title' ); ?></h2>
                                    <?php $image = get_sub_field( 'image' ); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ( $image ) : ?>
                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="container-sm mobile-space page-content-area content-list-squared">
                                     <br>
                                        <?php the_sub_field( 'single_content' ); ?>

                                    <br>
                                    <div class="text-align-center">
                                        <?php $button_link = get_sub_field( 'button_link' ); ?>
                                        <?php if ( $button_link ) : ?>
                                            <a class="btn btn-outline-dark btn-small align-items-center d-none d-lg-inline-flex" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?><span class="icon-plus-light"></span></a>
                                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="btn btn-black btn-small align-items-center d-lg-none"><?php echo esc_html( $button_link['title'] ); ?> <span class="icon-plus-light"></span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( have_rows( 'double_content' ) ): ?>
            <div class="container">
                <div class="row justify-content-center content-list-squared">
                    <?php while ( have_rows( 'double_content' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == '2_column_content' ) : ?>
                            <?php if ( have_rows( 'add_column' ) ) : ?>
                                <?php while ( have_rows( 'add_column' ) ) : the_row(); ?>
                                    <div class="col-lg-<?php echo get_sub_field( 'column_width' ); ?> text-17 pt-40 page-content-area">
                                        <div class="text-align-center">
                                            <?php if( get_sub_field( 'heading' ) ): ?>
                                            <h2 class="mb-4"><?php the_sub_field( 'heading' ); ?></h2> 
                                            <?php endif; ?>
                                            <?php $image = get_sub_field( 'image' ); ?>
                                            <?php $size = '452X458'; ?>
                                            <?php if ( $image ) : ?>
                                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php the_sub_field( 'content' ); ?>
                                        <br>
                                        <?php $button_link = get_sub_field( 'button_link' ); ?>
                                        <?php if ( $button_link ) : ?>
                                            <a class="btn btn-outline-dark btn-small align-items-center d-none d-lg-inline-flex" href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?><span class="icon-plus-light"></span></a>
                                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="btn btn-black btn-small align-items-center d-lg-none"><?php echo esc_html( $button_link['title'] ); ?> <span class="icon-plus-light"></span></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
