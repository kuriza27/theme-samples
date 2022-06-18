<?php
/**
 * 
 *
 * Single Page Layout Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'single-page-layout-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-single-page-layout-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$size = '1920x826';
$banner_image = get_field( 'banner_image' );
if ( $banner_image ) :
    $bgImage =  wp_get_attachment_image_url( $banner_image, $size );
endif;

?>
<section class="section-block secondary-bg header-cover"  style="background-color: <?php the_field( 'background_color' ); ?>;background-image:url('<?php echo $bgImage;?>');background-size:cover;background-repeat: no-repeat;background-position: center;">
</section>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> single-column-section">
                <div class="container-sm animate-children">
                    <div class="text-md-center complete" style="transition-delay: 0s;">
                        <h3 class="h3 text-uppercase in-header-title"><span class="title-selected sec"><?php the_field( 'text_label' ); ?></span></h3>
                        <h1 class="mb-3"><?php the_title();?></h1>
                        <small><?php echo do_shortcode('[rt_reading_time label="" postfix="Minutes" postfix_singular="Minute"]'); ?> Read | Posted during <u><?php echo get_the_date('F j, Y'); ?></u></small></small>
                    </div>
                    <div class="content-admin pr-0 pt-4 pb-0 animate-children">
                         <?php the_field( 'content' ); ?>
                    </div>
                </div>
 </section>
 <?php if ( get_field( 'enable_join_conversation_section' ) == 1 ) : ?>
    <section class="join-conversation border-top section-padding">
                <div class="container text-center animate-children">
                    <h2 class="title-50">Join the <br class="d-none d-lg-inline">
                        Conversation</h2>
                    <a href="#" class="btn btn-primary show-comment">Leave a comment</a>
                    <div id="disqus-comment" class="mt-5 comment-section">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-sm-12">
                                <div class="comment-container">
                                    <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
<?php endif; ?>