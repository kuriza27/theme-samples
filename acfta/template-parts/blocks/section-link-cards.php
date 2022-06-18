<?php
$id = 'link-cards-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-fullwidth-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$headerTitle = get_field( 'heading_title' );

$selected_width = get_field( 'container_width' );


if( $selected_width == 'default' ) {
    $container_width = '';
} elseif ( $selected_width == 'sm' ) {
    $container_width = '-sm';
} else {
    $container_width = '-fluid';
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="highlights-section low-caps highlights-section-no-slider <?php echo esc_attr( $classes ); ?> link-cards-area">
    <div class="container<?php echo $container_width; ?> <?php if ( get_field( 'enable_mobile_slider_links' ) == 1 ) : ?>d-none d-lg-block <?php endif;?>">
        <?php if($headerTitle):?>
            <div class="row">
                            <div class="col">
                                <h2><?php the_field( 'heading_title' ); ?></h2>
                            </div>
            </div>
        <?php endif; ?>
        <div class="row gutter-22">
            <?php if ( have_rows( 'link_pages' ) ) : ?>
                <?php while ( have_rows( 'link_pages' ) ) : the_row(); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
                <!--card--->
                <?php if ( get_field( 'enable_4_columns' ) == 1 ) : ?>
                    <div class="col-lg-3 mb-2">
                <?php else : ?>
                    <div class="col-lg-4 mb-2">
                <?php endif; ?>
                    <?php if ( get_sub_field( 'with_content' ) == 1 ) : ?>
                        <div class="funding-section-content">
                            <h2><?php the_sub_field( 'title' ); ?></h2>
                            <p class="text-break"><?php the_sub_field( 'descritiption' ); ?></p>
                            <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" class="btn btn-white" target="<?php echo esc_attr( $link['target'] ); ?>">Explore</a>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <?php if ( $link ) : ?>
                        <a href="<?php echo esc_url( $link['url'] ); ?>" class="highlight-box d-flex" target="<?php echo esc_attr( $link['target'] ); ?>">
                        <?php else:?>
                            <a href="#" class="highlight-box d-flex">
                        <?php endif; ?>
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = '607x650'; ?>
                            <?php if ( $image ) : ?>
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                            <?php endif; ?>
                            <h3><?php the_sub_field( 'title' ); ?></h3>
                        </a>
                    <?php endif; ?>                
                </div>
                <!--/card--->
                <?php endwhile; ?>
            <?php endif; ?>       
        </div>
    </div>
    <div class="highlights-slider js-highlights-slider <?php if ( get_field( 'enable_mobile_slider_links' ) == 1 ) : ?>d-lg-none <?php else: ?> d-none<?php endif;?>">
            <?php if ( have_rows( 'link_pages' ) ) : ?>
                <?php while ( have_rows( 'link_pages' ) ) : the_row(); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
                    <div class="sl">
                        <?php if ( $link ) : ?>
                        <a href="<?php echo esc_url( $link['url'] ); ?>" class="highlight-box d-flex align-items-end" target="<?php echo esc_attr( $link['target'] ); ?>">
                        <?php else:?>
                        <a href="#" class="highlight-box d-flex align-items-end">
                        <?php endif; ?>
                        <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = '607x650'; ?>
                            <?php if ( $image ) : ?>
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                            <?php endif; ?>
                            <h3><?php the_sub_field( 'title' ); ?></h3>
                        </a>
                    </div>
                    <?php endwhile; ?>
            <?php endif; ?>   
                    
    </div>
</section>