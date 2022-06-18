<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-page-banner.php
 *
 * Page Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-banner-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-banner-v2';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$title = empty( get_field( 'title' ) ) ? get_the_title( $post_id ) : get_field( 'title' );
$banner_image = get_field( 'banner_image' );
$size = '1920x721';

if ( get_field( 'banner_text_color') == 'black' ) {
	$colorClass = '';
}
else {
	$colorClass = 'text-white';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> header page-banner pt-140 bg-cover bg-primary <?php echo $colorClass; ?> <?php the_field( 'banner_image_class' ); ?>" style="background-image:url(<?php echo wp_get_attachment_image_url( $banner_image, $size ); ?>);">
    <div class="header-content">
        <div class="container">
                <div class="row">
                        <div class="col">
                            <div class="row align-items-end">
                                <div class="col-12">
                                    <h1 class="mb-2 mb-md-4"><?php echo $title; ?></h1>
                                    <?php the_field( 'header_content' ); ?>
                                </div>
                                <div class="col-12 d-flex justify-content-end d-lg-none">
                                    <div class="mobile-space">
                                        <!--<ul class="share-list list-unstyled d-flex mb-0">
                                            <li><a href="#"><span class="icon-share-2"></span></a></li>
                                            <li><a href="#"><span class="icon-email"></span></a></li>
                                            <li><a href="#"><span class="icon-plus"></span></a></li>
                                        </ul>-->
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">

                        </div>
                </div><!--/row--->
        </div>
    </div>


    <div class="breadcrumb-container light mt-4">
        <div class="container">
            <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
        </div>
    </div>
   
    
</section>

