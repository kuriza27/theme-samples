
<?php
/**
 * Block template file: C:\wamp64\www\NODA\livinwp/wp-content/themes/livin/template-parts/blocks/block-home-banner.php
 *
 * Home Banner Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'page-text-banner-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-page-text-banner-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	.page-text-banner-section{
        background-color:<?php the_field( 'background_color' ); ?>;
        color:<?php the_field( 'text_color' ); ?>;
    }
</style>
<section id="<?php echo esc_attr( $id ); ?>" class="section-block page-text-banner-section <?php echo esc_attr( $block['className'] ); ?> <?php the_field( 'block_custom_class' ); ?>">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col text-center text-md-left animate-children">
                    <h1><?php the_field( 'heading' ); ?></h1>
                    <h3><?php the_field( 'subtext' ); ?></h3>
                    <?php if ( have_rows( 'button' ) ) : ?>
                    <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                        <?php $button_link = get_sub_field( 'button_link' ); ?>
                        <?php if ( $button_link ) : ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>" class="btn-primary unstyled"><?php echo esc_html( $button_link['title'] ); ?></a>
                        <?php endif; ?>
                        <?php endwhile; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div><!-- .header-content -->
</section>