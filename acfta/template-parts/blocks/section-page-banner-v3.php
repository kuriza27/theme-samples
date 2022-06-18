<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-page-banner-v3.php
 *
 * Page Banner V3 Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-banner-v3-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-banner-v3';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$title = empty( get_field( 'title' ) ) ? get_the_title(  $post_id ) : get_field( 'title' );
$banner_image = get_field( 'banner_image' );
$size = '1920x721';

if ( get_field( 'banner_text_color',  $post_id ) == 'black' ) {
	$colorClass = '';
}
else {
	$colorClass = 'text-white';
}

if( is_admin() ) {
    $term_cat = get_the_terms( $post_id, 'category' )[0];
}
else {
    $term_cat = get_the_terms( get_the_ID(), 'category' )[0];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> header page-banner pt-140 bg-cover bg-primary <?php echo $colorClass; ?> <?php the_field( 'banner_image_class' ); ?>" style="background-image:url(<?php echo wp_get_attachment_image_url( $banner_image, $size ); ?>);">
    <?php if(!empty($banner_image)):?>  
        <div class="header-content d-flex">
                    <div class="container d-flex w-100">
                        <div class="row w-100">
                            <div class="col col-lg-9 d-flex flex-column justify-content-between">
                                <a href="<?php echo get_category_link( $term_cat ); ?>" class="btn btn-category btn-sm"><?php  echo esc_html( $term_cat->name ); ?></a>
                                <?php 
                                    $title = get_field( 'title' );
                                 ?>
                                <h1><?php echo  $title; ?></h1>
                            </div>
                            <h6 class="col-12 text-right d-none d-lg-block"><?php the_field( 'image_credit' ); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-container mobile-space">
                    <div class="container">
                    <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
                        <div class="breadcrumb-container mobile-space">
                            <div class="container text-14">
                                <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
        <!---/header-content--->
        <?php else:?>
                <div class="d-flex">
                        <div class="container d-flex w-100">
                            <div class="row w-100">
                                <div class="col pt-140 col-lg-9 d-flex flex-column justify-content-between">

                                    <a href="<?php echo get_category_link( $term_cat ); ?>" class="btn btn-category btn-sm"><?php echo $term_cat->name; ?></a>
                                    <?php 
                                        $title = get_field( 'title' );
                                    ?>
                                    <h1><?php echo $title ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-container mobile-space">
                        <div class="container">
                        <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
                            <div class="breadcrumb-container mobile-space">
                                <div class="container text-14">
                                    <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
    
            
            </div><!---/header-content--->
       <?php endif;?>
</section>
 <!-- page-content -->
 <div class="page-content">
            <div class="social-share-block mobile-space">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                   
                                    <strong>Published | <?php $post_date = get_the_date( 'd.m.Y' ); echo $post_date;?> | <?php echo do_shortcode('[rt_reading_time postfix="minutes" postfix_singular="minute" post_id='."$post_id".']');?> read</strong>
                                </div>
                                <div class="col-auto">
                                    <!--<ul class="share-list list-unstyled d-flex mb-0 justify-content-end">
                                        <li><a href="#"><span class="icon-share-2"></span></a></li>
                                        <li><a href="#"><span class="icon-email"></span></a></li>
                                        <li><a class="white-bg" href="#" data-toggle="tooltip" data-placement="bottom" title="Save to your reading list"><span class="icon-plus"></span></a></li>
                                    </ul>-->
                                    <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 </div>
