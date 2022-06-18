<?php
$id = 'testimonial-brands-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

?>

<section id="<?php echo esc_attr( $id ); ?>" class="brands-section position-relative <?php echo esc_attr( $block['className'] ); ?>" style="background-color:<?php the_field( 'background_color' );?>">
    <div class="container text-center animate-children">
        <div class="container-sm">
            <h2><?php the_field( 'heading' ); ?></h2>
            <blockquote class="mb-4 mb-lg-5 text-white">
                <span class="blockquote-quote title-80">“</span>
                <?php the_field( 'testimonial' ); ?>
            </blockquote>
            <div class="cite-logo-dflex">
            <?php if(get_field( 'cite_title' )) {?><h3 class="cite-title"><?php the_field( 'cite_title' ); ?></h3><?php } ?>
            <?php if ( get_field( 'enable_cite_logo_hover' ) == 1 ) : ?>
                <a href="<?php the_field( 'cite_link' ); ?>" target="_blank">
                    <img data-hoverimg="<?php the_field( 'cite_logo_original' );?>" data-originalimg="<?php the_field( 'cite_logo_hover_image' ); ?>" src="<?php the_field( 'cite_logo_hover_image' ); ?>" onmouseover="hover(this);" onmouseout="unhover(this);">
                </a>
            </div>
            <?php else : ?>
                <?php $cite_logo = get_field( 'cite_logo' ); ?>
                <?php if ( get_field( 'enable_cite_logo_full_size' ) == 1 ) : ?>
                    <?php $size = 'medium'; ?>
                <?php else: ?>
                    <?php $size = '235x40'; ?>
                <?php endif; ?>
                    <?php if ( $cite_logo ) : ?>
                        <a href="<?php the_field( 'cite_link' ); ?>" target="_blank"><?php echo wp_get_attachment_image( $cite_logo, $size ); ?></a>
                    <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if ( have_rows( 'brand_logos' ) ) : ?>
        <div class="brands-s-brands">
            <h3><?php the_field( 'brands_heading' ); ?></h3>
            <div class="partners-list js-partners-list">
                <?php while ( have_rows( 'brand_logos' ) ) : the_row(); ?>
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php $size = '220x56'; ?>
                    <?php if ( $image ) : ?>
                        <a href="<?php the_sub_field( 'url' ); ?>" class="sl" target="_blank"><?php echo wp_get_attachment_image( $image, $size ); ?>
                    <?php endif; ?>                    
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>