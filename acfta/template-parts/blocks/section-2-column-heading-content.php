<?php
$id = 'heading-content-2-column-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-heading-content-2-column';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<hr class="m-0">
<section id="<?php echo esc_attr( $id ); ?>" class="au-cauncil-section <?php echo $classes; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2><?php the_field( 'heading' ); ?></h2>
                <?php $image = get_field( 'image' ); ?>
                <?php $size = '607x650'; ?>
                <?php if ( $image ) : ?>
                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 text-17">
                <?php the_field( 'content' ); ?>
                <br>
                <?php $button = get_field( 'button' ); ?>
	            <?php if ( $button ) : ?>
                    <a class="btn btn-outline-dark btn-small align-items-center d-none d-lg-inline-flex" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></a>
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="btn btn-black btn-small align-items-center d-lg-none"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></a>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</section>