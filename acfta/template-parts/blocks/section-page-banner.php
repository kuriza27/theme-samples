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
$classes = 'block-page-banner';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$title = empty( get_field( 'title' ) ) ? get_the_title( $post_id ) : get_field( 'title' );
$banner_image = get_field( 'banner_image' );
$size = '1920x721';

if ( get_field( 'banner_text_color', $post_id ) == 'black' ) {
	$colorClass = '';
}
else {
	$colorClass = 'text-white';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>  header page-banner pt-140 bg-cover bg-primary <?php echo $colorClass; ?> <?php the_field( 'banner_image_class' ); ?>" style="background-image:url(<?php echo wp_get_attachment_image_url( $banner_image, $size ); ?>);">
    <?php if ( get_field( 'enable_social_media_banner' ) == 1 ) : ?>
     <?php if(!empty($banner_image)):?>
        <div class="header-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row align-items-end  text-white">
                                    <div class="col-9 col-sm-8">
                                        <h1><?php echo $title; ?></h1>
                                        <?php
                                            global $post;
                                            $pageID = $post->ID;
                                            $ref = get_field( 'reference_n', $pageID);
                                            if($ref):
                                        ?>
                                                <span class="reference-text text-white">Reference No</span><br>
                                                <span class="reference-no text-white"><?php echo$ref;?></span><br>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-3 col-sm-4 d-flex justify-content-end text-white">
                                        <!--<ul class="share-list-light list-unstyled d-flex mb-0">
                                            <li><a href="#"><span class="icon-share-2"></span></a></li>
                                            <li><a href="#"><span class="icon-email"></span></a></li>
                                            <li><a href="#"><span class="icon-plus"></span></a></li>
                                        </ul>-->
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <?php else:?>
            <div class="">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row align-items-end  text-white">
                                    <div class="col-9 col-sm-8 pt-140">
                                            <h1><?php echo $title; ?></h1>
                                            <?php
                                                global $post;
                                                $pageID = $post->ID;
                                                $ref = get_field( 'reference_n', $pageID);
                                                if($ref):
                                            ?>
                                                    <span class="reference-text text-white">Reference No</span><br>
                                                    <span class="reference-no text-white"><?php echo$ref;?></span><br>
                                            <?php endif;?>
                                    </div>
                                    <div class="col-3 col-sm-4 d-flex justify-content-end text-white">
                                        <!--<ul class="share-list-light list-unstyled d-flex mb-0">
                                            <li><a href="#"><span class="icon-share-2"></span></a></li>
                                            <li><a href="#"><span class="icon-email"></span></a></li>
                                            <li><a href="#"><span class="icon-plus"></span></a></li>
                                        </ul>-->
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <?php endif;?>
	<?php else : ?>
            <div class="header-content d-flex">
                <div class="container d-flex w-100">
                    <div class="row w-100">
                    <?php if ( get_field( 'has_sidebar' ) == 1 ):?>
                            <div class="col">
                                <div class="header-content-opportunities-full"> 
                                    <h1><?php echo $title; ?></h1>
                                    <?php the_field( 'header_content' ); ?>
                                </div>
                            </div>
                    <?php else: ?>
                            <div class="col d-flex flex-column pb-4">
                                <div class="header-content-opportunities-full"> 
                                    <h1><?php echo $title; ?></h1>
                                    <?php the_field( 'header_content' ); ?>
                                </div>
                            </div>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        <?php if ( get_field( 'has_sidebar' ) == 1 ):?>
            <div class="container">
                <div class="text-right col-lg-8">
                    <h6 class="align-self-end mt-auto d-none d-md-block text-white image-credit image-credit-sidebar"><?php the_field( 'image_credit' ); ?></h6>
                </div>
            </div>
        <?php else: ?>
            <div class="container-fluid">
                <div class="text-right col-lg-11">
                    <h6 class="align-self-end mt-auto d-none d-md-block text-white image-credit image-credit-full"><?php the_field( 'image_credit' ); ?></h6>
                </div>
            </div>
        <?php endif;?>
	<?php endif; ?>
    <div class="mt-5">
        <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
            <div class="breadcrumb-container mobile-space">
                <div class="container text-14">
                    <nav aria-label="breadcrumb">
                        <?php yoast_breadcrumb('<ol class="breadcrumb"><li class="breadcrumb-item">','</li></ol>'); ?>
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
            <div class="col<?php if ( get_field( 'has_sidebar' ) == 1 ){ echo '-xl-8'; } ?>">
                <?php echo do_shortcode('[addtoany]'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
