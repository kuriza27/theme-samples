<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-content-without-sidebar.php
 *
 * Content Without Sidebar Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'content-without-sidebar-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-content-without-sidebar';
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
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> post-entry <?php echo $pageClass;?>">
                        <div class="container-sm">

                        <?php if ( have_rows( 'content' ) ): ?>
                            <?php while ( have_rows( 'content' ) ) : the_row(); ?>
                                <?php if ( get_row_layout() == 'content' ) : ?>
                                    <div class="mobile-space ">
                                        <div class="page-content-area page-content-no-sidebar content-list-squared">
                                            <?php the_sub_field( 'content' ); ?>
                                        </div>
                                        <?php $button = get_sub_field( 'button' ); ?>
                                        <?php if ( $button ) : ?>
                                        <div class="col-lg-12 mb-4" style="padding:0!important">
                                            <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" class="btn btn--dark btn-small"><?php echo esc_html( $button['title'] ); ?> <span class="icon-plus-light" style="font-size:1em"></span></a><!--to widen/one line the text and make small the plus icon-->
                                        </div>
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
                                    <?php $image = get_sub_field( 'image' ); ?>
                                    <?php $imgcaption =get_sub_field( 'image_caption' ); ?>
                                    <?php $size = '990x557'; ?>
                                    <?php if ( $image ) : ?>
                                        <?php if ( $imgcaption ) :?>
                                            <figure>
                                                <div class="row mx-sm-0">
                                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                                    <figcaption class="<?php the_sub_field( 'caption_alignment' ); ?> mobile-space"><?php the_sub_field( 'image_caption' ); ?></figcaption>
                                                </div>
                                            </figure>
                                        <?php else: ?>
                                            <div class="row mx-sm-0">
                                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                                                </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php elseif ( get_row_layout() == 'accordion_list' ) : ?>
                                    <?php if ( have_rows( 'accordion' ) ) : ?>
                                        <div class="bg-white major-performing-arts-page"><!--/accordion list--->
                                            <div class="accordion" id="accordionExample2" style="position:relative">
                                                <?php $i=1;while ( have_rows( 'accordion' ) ) : the_row(); ?>
                                                    <div class="card">
                                                        <div class="card-header" id="question<?php echo $i;?>">
                                                            <h3 class="mb-0">
                                                                <button class="btn btn-link text-align-left plus-icon-end" type="button"
                                                                        data-toggle="collapse" data-target="#question-collapse<?php echo $i;?>"
                                                                        aria-expanded="false" aria-controls="question-collapse<?php echo $i;?>">
                                                                        <?php the_sub_field( 'title' ); ?>
                                                                    <span class="icon-plus-light"></span>
                                                                </button>
                                                            </h3>
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
                                <?php elseif ( get_row_layout() == 'add_button' ) : ?>
                                        <?php if ( have_rows( 'button_link' ) ) : ?>
                                            <div class="row pt-20 mb-4">
                                                <?php while ( have_rows( 'button_link' ) ) : the_row(); ?>
                                                    <?php $button_link = get_sub_field( 'button_link' ); ?>
                                                    <?php if ( $button_link ) : ?>
                                                        <div class="col-lg-auto col-12 col-sm-6 mb-2">
                                                            <a class="text-20 btn btn--dark btn-block"  href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>">
                                                                <?php echo esc_html( $button_link['title'] ); ?>
                                                            </a>
                                                        </div>
                                                <?php endif; ?>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                              <?php elseif ( get_row_layout() == 'content_with_background_and_button' ) : ?>
                                        <?php $bgColor = get_sub_field( 'select_background_color' ); ?>
                                        <div class="mobile-space page-content-area" style="background-color:<?php echo $bgColor;?>;padding:40px;margin-bottom:30px;">
                                            <?php the_sub_field( 'content' ); ?>
                                            <?php $button_links = get_sub_field( 'button_links' ); ?>
                                            <?php if ( $button_links ) : ?>
                                                <a href="<?php echo esc_url( $button_links['url'] ); ?>" class="text-20 btn btn--dark btn-block col-sm-auto col-sm-3" target="<?php echo esc_attr( $button_links['target'] ); ?>"><?php echo esc_html( $button_links['title'] ); ?></a>
                                            <?php endif; ?>
                                        </div>
                                <?php endif; ?><!--/endif--->
                            <?php endwhile; ?>
                            <?php endif; ?>
                         </div>
                   
                
            </section>