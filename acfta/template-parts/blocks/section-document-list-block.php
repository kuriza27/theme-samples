<?php
/**
 *
 * Document List Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'document-list-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-document-list-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> selects-section overflow-hidden border-top-0 pt-lg-5">
        <div class="container documents-list list-main-container">
            <h2><?php the_field( 'heading_title' ); ?></h2><br>
                <div class="row" id="results-area">
                    <?php if ( have_rows( 'add_document' ) ) : ?>
                        <?php while ( have_rows( 'add_document' ) ) : the_row(); ?>
                            <?php $documents = get_sub_field( 'documents' ); ?>
                            <?php if ( $documents || get_sub_field( 'add_title_manually' ) == 1) : ?>
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="document-box d-flex">
                                                    <div class="doc-img d-flex justify-content-center align-items-center">
                                                        <?php the_sub_field( 'file_format' ); ?>
                                                    </div>
                                                    <?php $link = get_sub_field( 'link' ); ?>
                                                        <div class="document-info">
                                                            <?php if ( get_sub_field( 'add_title_manually' ) == 1 ) : ?>
                                                                <h4><a href="<?php echo esc_url( $link['url'] ); ?>" download><?php the_sub_field( 'document_title' ); ?></a></h4>
                                                            <?php else:?>
                                                                <h4><a href="<?php echo esc_url( $link['url'] ); ?>" download><?php echo get_the_title( $documents ); ?></a></h4>
                                                            <?php endif; ?>
                                                            <div class="links-group d-flex">
                                                                    <?php if ( $link ) : ?>
                                                                        <a href="<?php echo esc_url( $link['url'] ); ?>" download>Download</a>
                                                                        <a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank">Print</a>
                                                                        <a></a>
                                                                        <a class="ml-auto" href="<?php echo esc_url( $link['url'] ); ?>" download><span class="icon-plus-light"></span></a>
                                                                    <?php endif; ?>
                                                            </div>
                                                        </div>
                                            </div>
                                        </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div><!-- /row -->
        </div><!-- /container -->
</section>