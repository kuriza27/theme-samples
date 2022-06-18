<?php
/**
*
* Banner Option Block Block Template.
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/
// Create id attribute allowing for custom "anchor" value.
$id = 'banner-option-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-banner-option-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$add_background_image = get_field( 'add_background_image' );
$size = 'full';
if ( $add_background_image ) :
    $bgImage =  wp_get_attachment_image_url( $add_background_image, $size );
endif;
?>

<?php 
if ( get_field( 'add_background_gradient_overlay' ) == 1 ) :
    $gradient = get_field( 'gradient_color' ); 
    $gradientColor = hex2rgba($gradient);
    echo $gradientColor;
endif;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="d-flex flex-column section-block banner-options-section secondary-bg <?php echo esc_attr( $classes ); ?> position-relative <?php if($bgImage):?>pt-300<?php endif;?>" style="background-color: <?php the_field( 'background_color' ); ?>;background-image:<?php if ( get_field( 'enable_background_gradient_overlay' ) == 1 ) : ?>linear-gradient(20.35deg, #C4C4C4 35.98%, rgba(196, 196, 196, 0) 63.47%),<?php endif;?>url('<?php echo $bgImage;?>');background-size:cover;background-repeat: no-repeat;background-position: center;">
    <?php if ( get_field( 'enabled_animated_text_background' ) == 1 ) : ?>
                <div class="section-overlay-animation">
                    <div class="text-row d-flex"><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span>
                    </div>
                </div>
    <?php endif; ?>    
    <div class="container d-flex mt-auto <?php if ( get_field( 'inline_form_button' ) == 1 ) { echo 'pb-5'; } ?>">
        <div class="row banner-option-area">
                <div class="col-lg-9 col-xl-7">
                    <div class="text-center text-md-left animate-children text-white banner-inner--padding">
                        <div class="banner-inner--content">
                            <?php the_field( 'content' ); ?>
                        </div>
                        <?php $form = get_field( 'form' );?>
                        <?php if ( $form ) : ?>
                            <?php 
                            $styles = get_field( 'form_button_styling' );
                            $btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
                            $btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
                            $btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
                            $btn_hover_color = ( $styles['text_hover_color'] != '' ) ? 'color: '. $styles['text_hover_color'] .' !important;' : '';
                            $btn_hover_bg_color = ( $styles['background_hover_color'] != '' ) ? 'background-color: '. $styles['background_hover_color'] .' !important;' : '';
                            $btn_hover_border_color = ( $styles['border_hover_color'] != '' ) ? 'border-color: '. $styles['border_hover_color'] .' !important;' : '';
                            $btn_style = $btn_color . $btn_bg_color . $btn_border_color;
                            $btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
                            ?>
                            <style type="text/css">#banner--form-btn form .gform_footer input[type="submit"]{<?php echo $btn_style; ?>}#banner--form-btn form .gform_footer input[type="submit"]:hover{<?php echo $btn_hover_style; ?>}</style>
                            <div id="banner--form-btn" class="<?php if ( get_field( 'inline_form_button' ) == 1 ) { echo 'form--button-inline'; } ?> banner-form--wrapper">
                            <?php echo do_shortcode('[gravityform id="'.$form.'" title="true" description="true" ajax="true"]'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( get_field( 'subtext' ) ): ?>
                        <p><?php the_field( 'subtext' ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
        </div>            
    </div><!-- .container -->
    <div class="container">
    <?php $partnerHeading = get_field( 'partners_list_heading' ); ?>
        <?php if ( $partnerHeading ) : ?>
            <div class="text-center text-white">
                  <h2><?php echo $partnerHeading; ?></h2>
            </div>
        <?php endif; ?>
    </div>
    <div class="container d-flex">
        <div class="row w-100 align-items-end animate-children banner--logo-slider">
            <div class="col-lg-12 d-xs-block d-none d-md-none d-lg-none">
                <?php $stamp = get_field( 'stamp' ); ?>
                <?php $size = 'thumbnail'; ?>
                <?php if ( $stamp ) : ?>
                    <?php echo wp_get_attachment_image( $stamp, $size ); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-10 col-md-8 col-sm-6 animate-children">
                <div class="partners-list js-partners-list-options banner-inner--padding">
                    <?php if ( have_rows( 'logos' ) ) : ?>
                        <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                            <?php $url = get_sub_field( 'url' ); ?>
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = '220x56'; ?>
                            <?php if ( $image ) : ?>
                                <?php if ( $url ) : ?>
                                    <a href="<?php echo esc_url( $url['url'] ); ?>" target="<?php echo esc_attr( $url['target'] ); ?>" class="sl">
                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                    </a>
                                <?php else:?>
                                    <a href="" class="sl">
                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                    </a>
                                <?php endif; ?>  
                            <?php endif; ?>                    
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 stamp-mobile-space text-center text-md-right d-none d-md-block d-lg-block">
                <?php $stamp = get_field( 'stamp' ); ?>
                <?php $size = 'thumbnail'; ?>
                <?php if ( $stamp ) : ?>
                    <?php echo wp_get_attachment_image( $stamp, $size ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>