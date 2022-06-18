<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-page-header-single-post.php
 *
 * Page Header Single Post Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-header-single-post-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-header-single-post';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$bgColor =  get_field( 'background_color');
$textColor = get_field( 'text_color');
if ($bgColor=="green"){
    $bgColor = "#000";
    $textColor = '#FFF';
    $classes .= ' sharer-white';
}

$term_cat = get_the_category();

?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> header">
    <div class="header-content d-flex flex-column py-280" style="background-color:<?php echo $bgColor; ?>; color:<?php echo $textColor; ?>;">
                <div class="container">
                    <div class="row">
                        <div class="col pb-6">
                            <div class="row align-items-end">
                                <div class="col">
                                    <h1><?php the_field( 'heading_title' ); ?></h1>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block">

                        </div>
                    </div>
                </div>
                <div class="container mt-auto">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span style="color:<?php the_field( 'text_color' ); ?>;" class="reference-text"><?php $post_date = get_the_date( 'M d, Y' ); echo $post_date; ?></span>
                                </div>
                                <div class="col-auto">
                                    <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block"></div>
                    </div>
                </div>
     </div><!---/header content--->
        <div class="breadcrumb-container light mobile-space">
            <div class="container">
                <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
            </div>
        </div>
</section>