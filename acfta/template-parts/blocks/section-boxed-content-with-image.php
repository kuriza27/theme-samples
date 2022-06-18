
<?php
$id = 'boxed-content-with-image-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'block-boxed-content-with-image';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-boxed-content-with-image';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="img-text-section covid-audiance-section <?php echo $classes; ?>">
    <div class="container <?php if ( !(is_front_page()) ) : echo "page-inner-boxed-img"; endif;?>">
        <div class="img-text-box position-relative d-flex flex-wrap justify-content-end img-to-right">
            <?php $image = get_field( 'image' ); ?>
            <?php $size = '1190x766'; ?>
            <?php if ( $image ) : ?>
                <?php echo wp_get_attachment_image( $image, $size ); ?>
            <?php endif; ?>            
            <?php $link = get_field( 'link' ); ?>
            <div class="sl-text">
                <div class="fsm-top">
                    <h2><a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php the_field( 'heading' ); ?></a></h2>
                    <?php the_field( 'text' ); ?>
                </div>
                <?php if ( $link ) : ?>
                    <?php $buttonColor = get_field( 'button_color' ); ?>     
                        <?php if($buttonColor=="black"){?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" class="btn btn-black"><?php echo esc_html( $link['title'] ); ?></a>  
                            <?php } else{ ?>
                                <div class="text-right">
                                    <a class="more-link d-inline-flex align-items-center" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?> <span class="icon-plus-light"></span></a>
                                </div>
                            <?php } ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>