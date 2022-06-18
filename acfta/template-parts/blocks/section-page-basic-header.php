<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-page-basic-header.php
 *
 * Page Basic Header Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-basic-header-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-basic-header';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>
<section id="<?php echo esc_attr( $id ); ?>" class="header page-header-block pt-140 basic-page <?php echo esc_attr( $classes ); ?>">
    <div class="header-content">
                <div class="container-xl">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-5 col-xl-4">
                            <?php $image = get_field( 'image' ); ?>
                            <?php if ( $image ) : ?>
                                <img class="sect-img" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 col-lg-7">
                            <div class="row align-items-end">
                                <div class="col-12 col-xl pr-0">
                                    <h1 class="mb-4 mb-md-5 mt-4"><?php the_field( 'title' ); ?></h1>
                                </div>
                                <div class="col-12 d-flex justify-content-end col-xl-auto">
                                    <div class="mobile-space">
                                        <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>   
                                            <!--<ul class="share-list list-unstyled d-flex">
                                                <li><a href="#"><span class="icon-share-2"></span></a></li>
                                                <li><a href="#"><span class="icon-email"></span></a></li>
                                                <li><a href="#"><span class="icon-plus"></span></a></li>
                                            </ul>-->
                                            <?php echo do_shortcode('[addtoany]'); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <?php if ( get_field( 'show_sharer_block' ) == 1 ) : ?>
        <div class="breadcrumb-container light mt-4">
            <div class="container-xl">
                <div class="row justify-content-end">
                    <div class="col-xl-4"></div>
                    <div class="col-12 col-xl-7">
                        <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

