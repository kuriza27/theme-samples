<?php
global $post;

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-contact-form-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

$id = 'contact_form' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

?>
<section  id="<?php echo esc_attr( $id ); ?>" class="contact-section secondary-bg section-padding text-white <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate-children">
                <hgroup class="text-lg-center text-md-center">
                    <h3 class="h3 mb-5"><span class="title-selected text-uppercase"><?php the_field('top_text');?></span></h3>                   
                    <h1 class="alt mb-3"><?php the_field( 'title' ); ?></h1>
                </hgroup>
                <?php if(!empty(get_field('sub_text'))):?>
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10">
                            <p><?php the_field('sub_text');?> </p>
                        </div>
                    </div>
                <?php endif;?>
                <?php if ( have_rows( 'buttons' ) ) : ?>
                    <div class="row justify-content-center text-center mt-3">
                        <?php if ( get_sub_field( 'enable_custom_button_styling' ) == 1 ) : ?>test1
                        <?php $c=0; while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php $button = get_sub_field( 'button' ); ?>
                            <?php echo custom_button_styling(get_sub_field( 'button_styling' ), 'btn-'. get_sub_field_object( 'button' )['key'] . $c, get_sub_field( 'button' ), get_sub_field( 'enable_custom_button_styling' ), 'btn-primary d-inline-block mx-2', esc_attr( $id ), ''); ?>
                        <?php $c++; endwhile; ?>
                        <?php else : ?>
                        <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                            <?php $button = get_sub_field( 'button' ); ?>
                            <?php if ( $button ) : ?>
                                <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ); ?>" class="btn-primary d-inline-block mx-2 btn"><?php echo esc_html( $button['title'] ); ?></a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ( have_rows( 'media_content' ) ): ?>
                    <div class="row media-block justify-content-center text-center mt-3">
                        <?php while ( have_rows( 'media_content' ) ) : the_row(); ?>
                            <?php if ( get_row_layout() == 'video' ) : ?>
                                <div class="col-lg-10 animate-children">
                                    <?php the_sub_field( 'video' ); ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if ( have_rows( 'testimonial_block' ) ): ?>
                    <div class="row testimonial-block justify-content-center text-center mt-4">
                        <?php while ( have_rows( 'testimonial_block' ) ) : the_row(); ?>
                            <?php if ( get_row_layout() == 'testimonial_content' ) : ?>
                                <div class="col-lg-10 animate-children">
                                <h2><?php the_sub_field( 'heading_title' ); ?></h2>
                                    <?php if ( have_rows( 'testimonial' ) ) : ?>
                                        <div class="row js-review-slider">
                                            <?php while ( have_rows( 'testimonial' ) ) : the_row(); ?>
                                                <div class="sl col-lg-4 pt-3">
                                                    <blockquote> <?php the_sub_field( 'content' ); ?></blockquote>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if ( get_field( 'enable_2_column_content' ) == 1 ) : ?>
                    <?php if ( have_rows( 'content' ) ) : ?>
                        <div class="row d-flex testimonial-block justify-content-center text-center mt-3 content-review-block js-contentreview-boxes position-relative">
                            <?php $c=0; while ( have_rows( 'content' ) ) : the_row(); ?>
                                <div class="sl">
                                    <div class="donate-box ">
                                        <div class="donate-box-body">
                                            <?php the_sub_field( 'content_box' ); ?>
                                            <h5><?php the_sub_field( 'heading_title' ); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php $c++;endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                    <div class="row mt-4 mt-lg-5 pt-0 pt-lg-5 gutters-100 columnjm-2  <?php if ( get_field( 'disable_right_content' ) == 1 ) : ?>justify-content-center<?php endif; ?>">
                        <!--/check if right content is disabled -->
                        <?php if ( get_field( 'disable_right_content' ) == 1 ) : ?>
                            <div class="col-lg-10 animate-children" id="<?php the_field( 'form_id' ); ?>">
                                <?php if( get_field( 'form_heading' ) ): ?>
                                    <h2 class="mb-4"><?php the_field( 'form_heading' ); ?></h2>
                                <?php endif; ?>
                                <?php if ( get_field( 'enable_embedded_form' ) ) : ?>
                                    <div class="text-left klaviyo-newsletter">
                                            <?php the_field( 'embedded_form_code' ); ?>
                                    </div>
                                <?php else : ?>
                                <div class="text-left">
                                <?php if(!empty(get_field('gravity_form'))):?>
                                    <?php $gravity_form = get_field( 'gravity_form' ); ?>
                                        <?php if ( $gravity_form ) : ?>
                                        <div id="form--<?php echo esc_attr( $id ); ?>">
                                            <?php 
                                                $styles = get_field( 'form_button_styling' );
                                                $btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
                                                $btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
                                                $btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
                                                $btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
                                                $btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
                                                $btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
                                                $btn_style = $btn_color . $btn_bg_color . $btn_border_color;
                                                $btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
                                            ?>
                                            <style type="text/css">#form--<?php echo esc_attr( $id ); ?> form input[type="submit"]{<?php echo $btn_style; ?>}#form--<?php echo esc_attr( $id ); ?> form input[type="submit"]:hover{<?php echo $btn_hover_style; ?>}</style>
                                        
                                                <?php gravity_form( $gravity_form['id'], false, false, false, null, true ); ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif;?>                                                            
                                </div>
                                <?php endif; ?> <!--/end enable_embedded_form -->
                            </div>
                        <?php else : ?>
                        <div class="col-lg-7 animate-children" id="<?php the_field( 'form_id' ); ?>">
                            <?php if( get_field( 'form_heading' ) ): ?>
                                <h2 class="mb-4"><?php the_field( 'form_heading' ); ?></h2>
                            <?php endif; ?>
                            <?php if ( get_field( 'enable_embedded_form' ) ) : ?>
                                <div class="text-left klaviyo-newsletter">
                                        <?php the_field( 'embedded_form_code' ); ?>
                                </div>
                            <?php else : ?>
                            <div class="text-left">
                              <?php if(!empty(get_field('gravity_form'))):?>
                                <?php $gravity_form = get_field( 'gravity_form' ); ?>
                                    <?php if ( $gravity_form ) : ?>
                                    <div id="form--<?php echo esc_attr( $id ); ?>">
                                        <?php 
                                            $styles = get_field( 'form_button_styling' );
                                            $btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
                                            $btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
                                            $btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
                                            $btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
                                            $btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
                                            $btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
                                            $btn_style = $btn_color . $btn_bg_color . $btn_border_color;
                                            $btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
                                        ?>
                                        <style type="text/css">#form--<?php echo esc_attr( $id ); ?> form input[type="submit"]{<?php echo $btn_style; ?>}#form--<?php echo esc_attr( $id ); ?> form input[type="submit"]:hover{<?php echo $btn_hover_style; ?>}</style>
                                        <?php gravity_form( $gravity_form['id'], false, false, false, null, true ); ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endif;?>                                                            
                            </div>
                            <?php endif; ?> <!--/end enable_embedded_form -->
                        </div>
                        <div class="col-lg-5 border-left white">
                            <?php the_field( 'content_right' ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
            </div>
        </div><!--/end row -->
    </div>
</section>