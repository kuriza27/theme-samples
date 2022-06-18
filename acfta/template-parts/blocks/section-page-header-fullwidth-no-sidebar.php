<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-page-header-no-sidebar.php
 *
 * Page Header No Sidebar Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-header-no-sidebar-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-header-no-sidebar';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$title = empty( get_field( 'title' ) ) ? get_the_title( $post->ID ) : get_field( 'title' );
$cat = get_the_category();
$catName = "";

if(isset($cat)){
    $catName = $cat[0]->name;
}

?>
<section id="<?php echo esc_attr( $id ); ?>" class="page-header-block pt-200 header <?php echo esc_attr( $classes ); ?>">
    <div class="header-content">
        <div class="container<?php if ( get_field( 'align_center' ) == 1 ) : ?>-sm<?php endif; ?>">
                <?php if ( get_field( 'align_center' ) == 1 ) : ?>  
                  <div class="row align-items-end justify-content-between">
                    <?php else:?>
                    <div class="row align-items-end">
                    <?php endif; ?>
                        <?php if ( get_field( 'align_center' ) == 1 ) : ?>
                            <div class="col-12 col-xl pb-4 pb-xl-0">
                                <h1><?php echo $title; ?></h1>
                                <span class="reference-text"><?php echo $catName;?></span><br>
                                <?php if( $catName!='Biographies'):?>
                                <span class="reference-text"> <?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></span>
                                <?php endif; ?>
                            </div>
                        <?php else:?>
                            <div class="col-12 col-sm-8">
                                    <h1 class="mb-lg-0 mb-5"><?php echo $title; ?></h1><br>
                                    <span class="reference-text"><?php  echo $catName;?></span><br>
                                    <?php if($catName !='Biographies'):?>
                                    <span class="reference-text"> <?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></span>
                                    <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( get_field( 'align_center' ) == 1 ) : ?>
                            <div class="col-12 col-xl-auto d-flex justify-content-end pb-xl-3">
                        <?php else:?>
                            <div class="col-12 col-sm-4 d-flex justify-content-end">
                        <?php endif; ?>
                        <?php $cat = get_the_category(); if($catName=="Stories"):?>
                                <?php echo do_shortcode('[addtoany]'); ?>
                            <?php else:?>
                                <?php if ( get_field( 'show_sharer_block' ) == 1 ) : ?> 
                                    <?php if ( get_field( 'no_sidebar' ) == 1 ) : ?> 
                                        <?php echo do_shortcode('[addtoany]'); ?>
                                        <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                    </div>
                    <?php if ( get_field( 'no_sidebar' ) != 1 &&  $catName !="Stories") : ?>
                     <div class="col-lg-8"> <?php echo do_shortcode('[addtoany]'); ?></div>
                    <?php endif; ?>
        </div>
    </div>
    <?php if ( get_field( 'show_breadcrumb' ) == 1 ) : ?>
    <div class="breadcrumb-container light">
        <div class="container<?php if ( get_field( 'align_breadcrum_center' ) == 1 ) : ?>-sm<?php endif;?>">
            <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
        </div>
    </div>
    <?php endif; ?>
</section>
