<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-media.php
 *
 * Media Post Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'media-post-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-media-post-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

global $post;
$pageID = $post->ID;
$pageClass = get_field( 'page_content_class',$pageID);
?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> post-entry mobile-space <?php echo $pageClass;?>">
                <div class="container">
                <div class="row justify-content-center">
                        <div class="col-lg-7">
                        <?php if ( have_rows( 'content' ) ): ?>
                            <?php while ( have_rows( 'content' ) ) : the_row(); ?>
                                <?php if ( get_row_layout() == 'content' ) : ?>
                                        <?php the_sub_field( 'content' ); ?>
                                    <?php $button = get_sub_field( 'button' ); ?>
                                    <?php if ( $button ) : ?>
                                    <div class="col-lg-4 mb-4" style="padding:0!important">
                                        <button class="btn btn--dark btn-small"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light"></span></button>
                                    </div>
                                <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'video popup' ) : ?>
                                    <?php $video_popup = get_sub_field( 'video_popup' ); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ( $video_popup ) : ?>
                                        <div class="video-block position-relative mb-4">
                                            <?php echo wp_get_attachment_image( $video_popup, $size ); ?>
                                            <a href="#" class="video-play-button d-inline-flex align-items-center">Watch the video <span class="icon-play align-self-stretch d-inline-flex align-items-center justify-content-center"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php elseif ( get_row_layout() == 'image_section' ) : ?>
                                    <?php 
                                        $image = get_sub_field( 'image' ); 
                                        $imageCaption = get_sub_field( 'image_caption' ); 
                                    ?>
                                    <?php $size = '990x557'; ?>
                                    <?php if ( $image ) : ?>
                                        <figure>
                                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                                        <?php if( $imageCaption):?>
                                            <figcaption class="<?php the_sub_field( 'caption_aligment' ); ?>"><?php echo  $imageCaption; ?></figcaption>
                                        <?php endif;?>
                                        </figure>       
                                    <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'accordion_list' ) : ?>
                                    <?php if ( have_rows( 'accordion' ) ) : ?>
                                        <div class="bg-white major-performing-arts-page mobile-space"><!--/accordion list--->
                                            <div class="accordion" id="accordionExample2" style="position:relative">
                                                <?php $i=1;while ( have_rows( 'accordion' ) ) : the_row(); ?>
                                                    <div class="card">
                                                        <div class="card-header" id="question<?php echo $i;?>">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link text-align-left plus-icon-end" type="button"
                                                                        data-toggle="collapse" data-target="#question-collapse<?php echo $i;?>"
                                                                        aria-expanded="false" aria-controls="question-collapse<?php echo $i;?>">
                                                                        <?php the_sub_field( 'title' ); ?>
                                                                    <span class="icon-plus-light"></span>
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="question-collapse<?php echo $i;?>" class="collapse" aria-labelledby="question<?php echo $i;?>"
                                                            data-parent="#accordionExample2">
                                                            <div class="card-body">
                                                                <?php the_sub_field( 'content' ); ?>
                                                            </div>
                                                        </div>
                                                     </div>
                                                <?php $i++;endwhile; ?>
                                            </div>
                                        </div><!--/accordion list--->
                                        <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'alert_info' ) : ?>
                                    <div class="alert">
                                        <h3><?php the_sub_field( 'info_heading' ); ?></h3>
                                        <?php the_sub_field( 'info' ); ?>
                                    </div><!--/alert info--->
                                <?php endif; ?>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div><!--/row--->
                </div>
            </section>