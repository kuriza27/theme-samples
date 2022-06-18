<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/block-card-popup.php
 *
 * Block Card Modal Popup Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-card-modal-popup-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-block-card-modal-popup';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="facilitators-section <?php echo esc_attr( $classes ); ?>">
    <div class="container-xl">
        <div class="row d-none d-sm-flex">
            <div class="col">
                <h2><?php the_field( 'heading_title' ); ?></h2>
            </div>
        </div>
        <div class="row facilitator-boxes">
            <?php if ( have_rows( 'card_list' ) ) : ?>
                <?php while ( have_rows( 'card_list' ) ) : the_row(); ?>
                        <!--highlight--->
                            <?php if ( get_field( 'enable_4_columns' ) == 1 ) : ?>
                                <div id="highlightBox<?php echo $i;?>" class="col-lg-3 col-md-6 facilitator-content"> 
                            <?php else : ?>
                                <div id="highlightBox<?php echo $i;?>" class="col-lg-4 col-md-6 facilitator-content"> 
                            <?php endif; ?>
                                <a href="javascript:void();" class="highlight-box facilitator-box general-box d-flex">
                                    <div class="card-img-faci" data-target="#faciliatorModal"  data-toggle="modal">
                                    <?php $image = get_sub_field( 'image' ); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ( $image ) : ?>
                                        <?php echo wp_get_attachment_image( $image, $size,false,array( "class" => 'img-highlight' )); ?>
                                    <?php endif; ?>
                                        <h3><?php the_sub_field( 'heading' ); ?></h3>
                                        <button class="btn-reset  btn-plus"><span class="icon-plus-light"></span></button>
                                    </div>
                                </a>
                                <div class="facilitator-data container">
                                    <div class="row">
                                        <div class="col-lg-6 text-center">
                                        <?php $size = 'full'; ?>
                                         <?php echo wp_get_attachment_image( $image, $size,false,array( "class" => 'facil-img-2' )); ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="sect-text">
                                                <h3><?php the_sub_field( 'heading' ); ?></h3>
                                                <?php the_sub_field( 'popup_content' ); ?>
                                                <div class="modal-nav">
                                                <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                    <?php if ( $button_link ) : ?>
                                                        <a href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>" class="btn btn-outline-dark btn-small align-items-center d-lg-inline-block">
                                                            <?php echo esc_html( $button_link['title'] ); ?>    <span class="icon-plus-light"></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         </div>
                         <!--/highlight--->
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>