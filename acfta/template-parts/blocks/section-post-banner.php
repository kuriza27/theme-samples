<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-post-banner.php
 *
 * Post Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'post-banner-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-post-banner';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$title = empty( get_field( 'title' ) ) ? get_the_title( $post->ID ) : get_field( 'title' );
$banner_image = get_field( 'banner_image' );
$size = 'full';
$image_url = wp_get_attachment_image_url( $banner_image, $size );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> single-banner header pt-140 half-bg bg-primary text-white" style="background-image: url(<?php echo $image_url; ?>);">
    <div class="header-content d-flex">
        <div class="container d-flex w-100">
            <div class="row w-100">
                <?php if($banner_image):?>
                <div class="col d-flex flex-column">
                    <div class="header-content-opportunities">
                        <h1 class="mb-4"><?php echo $title; ?></h1>
                        <p><?php the_field( 'banner_text' ); ?></p>
                    </div>
                    <?php if ( get_field( 'has_sidebar' ) != 1 ) : ?>
                     <h6 class="align-self-end mt-auto d-none  image-credit d-lg-block"><?php the_field( 'image_credit' ); ?></h6>
                    <?php endif; ?>
                    <?php if ( get_field( 'has_sidebar' ) == 1 ) : ?>
                        <div class="container">
                            <div class="text-right col-lg-8">
                                <h6 class="align-self-end mt-auto d-none d-md-block text-white image-credit image-credit-sidebar"><?php the_field( 'image_credit' ); ?></h6>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php else:?>
                    <div class="header-content-opportunities-full">
                        <h1 class="mb-4"><?php echo $title; ?></h1>
                        <p><?php the_field( 'banner_text' ); ?></p>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    
    <?php if( get_field('hide_breadcrumb') == 1 ): ?>
        <!-- DO NOTHING -->
    <?php else: ?>
    <div class="breadcrumb-container mobile-space">
        <div class="container text-14">
            <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
        </div>
    </div>
    <?php endif; ?>
</section>

<?php if ( get_field( 'show_share_block' ) == 1 ) : ?>
<div class="social-share-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php echo do_shortcode('[addtoany]'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>