<?php
/**
 * 
 *
 * Block Podcast Page Banner Block Template.
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

// Create id attribute allowing for custom "anchor" value.
$id = 'block-podcast-page-banner-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-block-podcast-page-banner';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$banner_image = get_field( 'banner_image' );
$size = '1920x721';
?>
<section id="<?php echo esc_attr( $id ); ?>" class="header page-banner pt-140 bg-cover bg-primary text-white podcast-boxes" style="background-image:url(<?php echo wp_get_attachment_image_url( $banner_image, $size ); ?>);">
     <div class="header-content d-flex">
            <div class="container d-flex w-100">
                <div class="row w-100">
                    <div class="col-xl-8 d-flex flex-column justify-content-start podcast-info">
                        <h1><?php the_field( 'title' ); ?></h1>
                        <?php the_field( 'header_content' ); ?>
                        <h3 class="align-self-start d-lg-block"><a href="#" class="podcast-button" data-target="#faciliatorModal"  data-toggle="modal"><span class="icon-play-circle text-70"></span></a> <?php the_field( 'podcast_info' ); ?></h3>
                        <h6 class="align-self-end d-none d-lg-block"><?php the_field( 'image_credit' ); ?></h6>
                    </div>
                </div>
            </div>
        </div>
     <div class="podcast-data container">
            <div class="row">
                <div class="col-lg-auto text-center">
                    <div class="text-left">
                        <h3>Listen to this Episode</h3>
                        <?php the_field( 'podcast_url' ); ?>
                    </div><!--/sect-text -->
                </div>
            </div><!--/row -->
    </div>
    <div class="mt-5">
        <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
            <div class="breadcrumb-container mobile-space">
                <div class="container text-14">
                    <nav aria-label="breadcrumb">
                        <?php yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>'); ?>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>

</section>

<?php if ( get_field( 'show_share_block' ) == 1 ) : ?>
<div class="social-share-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <strong><p class="mt-2">Publish | <?php echo get_the_date('d.m.Y'); ?></p></strong>
            </div>
            <div class="col-xl-4">
                <?php echo do_shortcode('[addtoany]'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
