<?php
$id = 'fullwidth-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-fullwidth-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="full-width-content mobile-space mt-5">
    <div class="container page-content-area content-list-squared">
        <?php the_field('content'); ?>
        <br>
        <?php if ( have_rows( 'button_links' ) ) : ?>
            <?php while ( have_rows( 'button_links' ) ) : the_row(); ?>
                <?php $links = get_sub_field( 'links' ); ?>
                <?php if ( $links ) : ?>
                    <a class="text-20 btn btn--dark mb-2" href="<?php echo esc_url( $links['url'] ); ?>" target="<?php echo esc_attr( $links['target'] ); ?>"><?php echo esc_html( $links['title'] ); ?></a>
                <?php endif; ?>
            <?php endwhile; ?>
	    <?php endif; ?>
        <?php if ( have_rows( 'content_flexi' ) ): ?>
		    <?php while ( have_rows( 'content_flexi' ) ) : the_row(); ?>
			    <?php if ( get_row_layout() == 'content_with_background' ) : ?>
                    <?php $bgColor = get_sub_field( 'select_background' ); ?>
                    <div class="mobile-space page-content-area content-list-squared" style="background-color:<?php echo $bgColor;?>;padding:40px;margin-bottom:30px;">
                        <?php the_sub_field( 'content' ); ?>
                        <?php $button_link = get_sub_field( 'button_link' ); ?>
                        <?php if ( $button_link ) : ?>
                            <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="text-20 btn btn--dark btn-block col-sm-auto col-sm-3" target="<?php echo esc_attr( $button_link['target'] ); ?>"><?php echo esc_html( $button_link['title'] ); ?></a>
                        <?php endif; ?>
                    </div>
                <?php elseif ( get_row_layout() == 'logo_grid' ) : ?>
                    <h2 class="mb-4 mobile-space"> <?php the_sub_field( 'heading_title' ); ?></h2>
                    <?php if ( have_rows( 'logo' ) ) : ?>
                        <div class="row no-gutters">
                            <?php while ( have_rows( 'logo' ) ) : the_row(); ?>
                                <?php $add_image = get_sub_field( 'add_image' ); ?>
                                <?php $size = 'medium'; ?>
                                <div class="col-sm-4 col-12 py-70 bordered-box text-align-center flex-wrap d-flex no-h-img align-items-center justify-content-center">
                                    <?php if ( $add_image ) : ?>
                                        <?php $link = get_sub_field( 'link' ); ?>
                                        <?php if ( $link ) : ?>
                                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo wp_get_attachment_image( $add_image, $size,'',array( "class" => "w250_h130 h-auto w-auto" )); ?></a>
                                        <?php else: ?>
                                            <?php echo wp_get_attachment_image( $add_image, $size); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="d-block page-content-area">
                                        <br><br>
                                        <?php the_sub_field( 'caption' ); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div><br><br>
                    <?php endif; ?><!-- /logo-grid -->
			    <?php endif; ?>
		    <?php endwhile; ?>
	    <?php endif; ?>
    </div><!-- /page-container -->
</section>