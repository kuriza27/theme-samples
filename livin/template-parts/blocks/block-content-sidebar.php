
<?php
$id = 'content-sidebar-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
global $post;
$postId = $post->ID;
?>
<?php if ( get_field( 'enable_custom_styling_for_download_button_content' ) == 1 ) : ?>
	<style>
        .custom-button-content .btn-primary{
            background-color:<?php the_field( 'download_button_background_color' ); ?>;
            color:<?php the_field( 'download_text_color' ); ?>;
            border-color:<?php the_field( 'download_button_background_color' ); ?>;
        }

        .custom-button-content .btn-primary:hover{
            background-color:<?php the_field( 'download_button_hover_background_color' ); ?>;
            color:<?php the_field( 'download_text_hover_color' ); ?>;
            border-color:<?php the_field( 'download_button_hover_background_color' ); ?>;
            opacity: 1;
        }
    </style>
	
<?php endif; ?>
<section id="<?php echo esc_attr( $id ); ?>" class="main-section overflow-hidden <?php echo esc_attr( $block['className'] ); ?> <?php if ( get_field( 'enable_custom_styling_for_download_button_content' ) == 1 ) : ?>custom-button-content<?php endif; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <?php if ( get_field( 'hide_sidebar' ) == 1 ) : ?>
                <div class="col-lg-8">
            <?php else : ?>
                <div class="col-lg-7">
            <?php endif; ?>
                <div class="content animate-children">
                    <h3 class="h3 mb-5 text-uppercase pl-3"><span
                            class="title-selected"><?php the_title(); ?></span>
                    </h3>
                    <div class="content-block-container">
                        <?php the_field( 'content' ); ?>
                    </div>

                    <?php if ( have_rows( 'accordion' ) ) : ?>
                    <div class="internal-category animate-children">
                        <?php $c=0; while ( have_rows( 'accordion' ) ) : the_row(); ?>
                        <div class="filter-widget">
                            <a class="filter-toggle d-flex justify-content-between align-items-center"
                                role="button" data-toggle="collapse" href="#prodsFilter<?php echo $c; ?>"
                                aria-expanded="<?php if($c == 0){ echo 'true'; }else{ echo 'false'; } ?>" aria-controls="prodsFilter">
                                <?php the_sub_field( 'title' ); ?>
                                <span class="filter-toggle-icon"></span>
                            </a>
                            <div class="filter-collapse collapse <?php if($c==0){ echo 'show'; } ?>" id="prodsFilter<?php echo $c; ?>"
                                    aria-expanded="true"
                                    style="">
                                <?php the_sub_field( 'content' ); ?>
                            </div>
                        </div>
                        <?php $c++; endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <br>
                    <?php if ( have_rows( 'buttons' ) ) : ?>
                        <div class="btn-group flex-wrap mt-lg-5 ipad-align-center button-content-left">
                            <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-secondary', esc_attr( $id ), ''); ?>
                            <?php $c++; endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ( get_field( 'hide_sidebar' ) == 1 ) : ?>
                <!-- do nothing -->
            <?php else : ?>
            <?php if ( have_rows( 'sidebar' ) ): ?>

                <?php if ( get_field( 'hide_sidebar_on_mobile' ) == 1 ) : ?>
                    <div class="col-lg-5 v-delim-l d-none d-lg-block">
                <?php else : ?>
                    <div class="col-lg-5 v-delim-l">
                <?php endif; ?>
                <aside class="sidebar animate-children">
                <?php $count=0; while ( have_rows( 'sidebar' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'form_widget' ) : ?>                    
                        <div class="widget form-widget">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <p><?php the_sub_field( 'text' ); ?></p>
                        <?php $form = get_sub_field( 'form' ); ?>
                        <?php if ( $form ) : ?>
                            <?php $formID = $form['id']; ?>
                            <div id="sidebar--form-<?php echo $formID . $count; ?>">
                                <?php 
                                $style_id = '#sidebar--form-'. $formID . $count; 
                                $styles = get_sub_field( 'form_button_styling' );
                                $btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
                                $btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
                                $btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
                                $btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
                                $btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
                                $btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
                                $btn_style = $btn_color . $btn_bg_color . $btn_border_color;
                                $btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
                                ?>
                                <style type="text/css"><?php echo $style_id; ?> form input[type="submit"]{<?php echo $btn_style; ?>}<?php echo $style_id; ?> form input[type="submit"]:hover{<?php echo $btn_hover_style; ?>}</style>
							    <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'links_widget' ) : ?>
                    <div class="widget sidebar-menu">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <?php the_sub_field( 'links' ); ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'media_widget' ) : ?>
                    <div class="widget video-widget">
                        <div class="video-block">
                            <?php if ( get_sub_field( 'media' ) == 1 ) : ?>
                                <?php the_sub_field( 'video' ); ?>
                            <?php else : ?>
                                <?php $image = get_sub_field( 'image' ); ?>
                                <?php $size = '517x246'; ?>
                                <?php if ( $image ) : ?>
                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                    <button class="video-block-play">
                                        <svg width="79" height="89" viewBox="0 0 79 89" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                            <path d="M76.7617 41.052L6.53944 1.45204C5.17889 0.686441 3.51989 0.704041 2.17689 1.48724C0.825111 2.27924 0 3.72244 0 5.28883V84.4887C0 86.0551 0.825111 87.4983 2.17689 88.2903C2.86156 88.6863 3.62522 88.8887 4.38889 88.8887C5.12622 88.8887 5.87233 88.7039 6.53944 88.3255L76.7617 48.7255C78.1398 47.9423 79 46.4816 79 44.8888C79 43.296 78.1398 41.8352 76.7617 41.052Z"
                                                    fill="#EF5437"></path>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>                            
                        </div>
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <p><?php the_sub_field( 'text' ); ?></p>
                        <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'], get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary', esc_attr( $id ), ''); ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'social_media_widget' ) : ?>
                    <div class="social-wrap social-wrap-blog widget text-center text-md-left">
                        <h4 class="mb-4"><?php the_sub_field( 'title' ); ?></h4>
                        <?php if ( have_rows( 'social' ) ) : ?>
                        <ul class="social social-circle list-unstyled d-flex justify-content-md-start justify-content-lg-between justify-content-center">
                            <?php while ( have_rows( 'social' ) ) : the_row(); ?>
                            <li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank"><span class="icon-<?php the_sub_field( 'icon' ); ?>"></span></a></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'newsletter_widget' ) : ?>
                    <div class="widget form-widget">
                        <h4><?php the_sub_field( 'title' ); ?></h4>
                        <?php $form = get_sub_field( 'form' ); ?>
                        <?php if ( $form ) : ?>
                            <?php $formID = $form['id']; ?>
                            <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                        <?php endif; ?>
                    </div>
                    <?php elseif ( get_row_layout() == 'buttons_widget' ) : ?>
                    <div class="widget">
                        <h4 class="mb-4"><?php the_sub_field( 'title' ); ?></h4>
                        <?php if ( have_rows( 'buttons' ) ) : ?>
                        <div class="row gutters-10">
                            <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <div class="col-12 col-md-3 col-lg-6 d-flex">
                                <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c . $count, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-secondary w-100 d-flex align-items-center justify-content-center mb-2', esc_attr( $id ), ''); ?>
                            </div>
                            <?php $c++; endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php $count++; endwhile; ?>
                </aside>
            </div>            
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>