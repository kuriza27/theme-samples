<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-center-with-button.php
 *
 * Center With Button Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'center-with-button-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-center-with-button';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$bgColor = get_field( 'background_color' );
if($bgColor=='grey'){
    $bgClass = " bg-grey ";
}else{
    $bgClass = " bg-whites ";
}

?>
<hr class="m-0">
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo $classes; echo $bgClass;?>pb-2 pb-5">
    <div class="container py-70 text-align-center">
        <?php if ( have_rows( 'content_block' ) ): ?>
            <?php while ( have_rows( 'content_block' ) ) : the_row(); ?>
                <?php if ( get_row_layout() == 'content' ) : ?>
                    <div class="page-content-area">
                        <?php the_sub_field( 'content' ); ?>
                    </div>
                <?php elseif ( get_row_layout() == 'button' ) : ?>
                    <?php $buttons = get_sub_field( 'buttons' ); ?>
                    <?php if ( $buttons ) : ?>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                            <a class="btn btn-black mb-3" href="<?php echo esc_url( $buttons['url'] ); ?>" target="<?php echo esc_attr( $buttons['target'] ); ?>"><?php echo esc_html( $buttons['title'] ); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php elseif ( get_row_layout() == 'image_credit_caption' ) : ?>
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <br>
                        <div class="text-center">
                        <figure>
                                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                <figcaption> <?php the_sub_field( 'caption' ); ?></figcaption>
                        </figure>
                        </div>
                    <?php endif; ?>
			    <?php elseif ( get_row_layout() == 'alert_info' ) : ?>
                        <div class="alert">
                                <h3> <?php the_sub_field( 'heading' ); ?></h3>
                                <?php the_sub_field( 'content' ); ?>
                        </div>

                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

</section>

