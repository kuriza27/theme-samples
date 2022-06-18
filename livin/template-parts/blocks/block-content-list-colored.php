<?php
/**
 *
 * Content List Colored Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-list-colored-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-list-colored-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	.block-content-list-colored-block{
        background-color:<?php the_field( 'background_color' ); ?>;
        color:<?php the_field( 'text_color' ); ?>;
    }
</style>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="container content animate-children">
        <div class="font-nb"><?php the_field( 'tag_title' ); ?></div>
        <div class="content-w-85">
            <?php the_field( 'content' ); ?>
            <?php if ( get_field( 'enable_content_list' ) == 1 ) : ?>
                <div class="font-nb mt-7"><?php the_field( 'heading' ); ?></div>
                <?php if ( have_rows( 'add_content_list' ) ) : ?>
                    <ul>
                    <?php while ( have_rows( 'add_content_list' ) ) : the_row(); ?>
                        <li><?php the_sub_field( 'content_text' ); ?></li>
                    <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if ( get_field( 'enable_content_with_buttons' ) == 1 ) : ?>
<section class="<?php echo esc_attr( $classes ); ?> content-help-message-area">
            <div class="content animate-children">
                <div class="text-center"><h2><?php the_field( 'heading_content_button_title' ); ?></h2></div>
                    <br> <br>
                    <?php if ( have_rows( 'button_list' ) ) : ?>
                    <div class="row">
                        <div class="col d-flex margin-0-auto">
                            <div class="js-spread-message-slider">
                                <?php while ( have_rows( 'button_list' ) ) : the_row(); ?>
                                    <?php $add_buttons = get_sub_field( 'add_buttons' ); ?>
                                    <?php if ( $add_buttons ) : ?>
                                        <div class="col-md-3 btn-box-white">
                                            <a href="<?php echo esc_url( $add_buttons['url'] ); ?>" target="<?php echo esc_attr( $add_buttons['target'] ); ?>">
                                                <?php echo esc_html( $add_buttons['title'] ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
</section>
<?php endif; ?>