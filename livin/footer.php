<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Livin
 */

?>

        <!-- mobile-menu -->
        <div class="mobile-menu js-mobile-menu">
            <div class="mobile-menu-top d-flex justify-content-between align-items-center">
                <a href="#" class="menu-toggle js-menu-toggle"><span class="icon-close"></span></a>
                <form action="/" class="mobile-search-form">
                    <div class="position-relative d-flex flex-row-reverse align-items-center">
                        <label for="mobSearchInput" class="mb-0">
                            <span class="menu-search-btn" ><span class="icon-search"></span></span>
                        </label>
                        <input type="search" name="s" id="mobSearchInput" class="form-control" placeholder="   " value="<?php the_search_query(); ?>">
                    </div>
                </form>
            </div>
            <?php
                wp_nav_menu( array(
                    'menu'  => 'Main Menu',
                    'container'       => false,
                    'menu_class'      => 'mobile-menu-nav nav flex-column',
                    'walker'          => new mobile_main_menu_Walker(),
                ) );
            ?>
        </div>
        <div class="close-overlay js-menu-toggle"></div>
        <!-- /mobile-menu-->

		<!-- footer -->
        <footer class="footer primary-bg">
            <div class="footer-top">
                <div class="container">
                    <div class="row animate-children">
                        <div class="col-lg-8">
                            <div class="subscribe-block d-flex flex-column">
                                <h5><?php the_field( 'newsletter_heading', 'option' ); ?></h5>
                                <p class="order-lg-2"><?php  the_field( 'newsletter_text', 'option' ); ?></p> 
                                <?php if ( get_field( 'enable_embedded_form', 'option' ) == 1 ) : ?>
                                    <div class="footer-jm">
                                         <?php the_field( 'embedded_code', 'option' ); ?>
                                    </div>   
                                <?php else : ?>
                                <div class="footer-jm">
                                    <?php $form = get_field('form', 'option'); ?>
                                    <?php if ( $form ) : ?>
                                    <div id="footer--form-btn">
                                        <?php 
                                        $styles = get_field( 'form_button_styling', 'option' );
                                        $btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
                                        $btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
                                        $btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
                                        $btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
                                        $btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
                                        $btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
                                        $btn_style = $btn_color . $btn_bg_color . $btn_border_color;
                                        $btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
                                        ?>
                                        <style type="text/css">#footer--form-btn form input[type="submit"]{<?php echo $btn_style; ?>}#footer--form-btn form input[type="submit"]:hover{<?php echo $btn_hover_style; ?>}</style>
                                        <?php echo do_shortcode('[gravityform id="'.$form.'" title="true" description="true" ajax="true"]'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right border-left">
                            <div class="social-wrap">
                                <h5><?php the_field( 'sm_heading', 'option' ); ?></h5>
                                <?php if ( have_rows( 'social_media', 'option' ) ) : ?>
                                <ul class="social list-unstyled d-flex justify-content-lg-end">
                                    <?php while ( have_rows( 'social_media', 'option' ) ) : the_row(); ?>
                                        <li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank"><span class="icon-<?php the_sub_field( 'icon' ); ?>"></span></a></li>
                                    <?php endwhile; ?>
                                </ul>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                <div class="container">
                    <div class="row animate-children">
                        <div class="col-lg-8">
                            <div class="footer-widget-area widget">
                                <div class="row animate-children">
                                    <div class="col-lg-3">
                                        
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'menu' 			 => 'Footer Column 1',
                                                'container'		 => '',
                                                'menu_class'	 => 'list-unstyled'
                                            )
                                        );
                                        
                                    ?>
                                    </div>
                                    <div class="col-lg-3">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'menu' 			 => 'Footer Column 2',
                                                'container'		 => '',
                                                'menu_class'	 => 'list-unstyled'
                                            )
                                        );
                                    ?>
                                    </div>
                                    <div class="col-lg-3">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'menu' 			 => 'Footer Column 3',
                                                'container'		 => '',
                                                'menu_class'	 => 'list-unstyled'
                                            )
                                        );
                                    ?>
                                    </div>
                                    <div class="col-lg-3">
                                    <?php
                                        wp_nav_menu(
                                            array(
                                                'menu' 			 => 'Footer Column 4',
                                                'container'		 => '',
                                                'menu_class'	 => 'list-unstyled'
                                            )
                                        );
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 border-left">
                            <div class="footer-address">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <a class="logo d-sm-none" href="<?php echo site_url(); ?>">
                                            <?php $logo = get_field( 'logo', 'option' ); ?>
                                            <?php $size = '150x83'; ?>
                                            <?php if ( $logo ) : ?>
                                                <?php echo wp_get_attachment_image( $logo, $size ); ?>
                                            <?php endif; ?>
                                        </a>
                                        <?php the_field( 'info', 'option' ); ?>
                                    </div>
                                    <div class="col-sm-5" id="footer--donate-btn">
                                        <a class="logo d-none d-sm-block text-lg-right" href="<?php echo site_url(); ?>">
                                            <?php $logo = get_field( 'logo', 'option' ); ?>
                                            <?php $size = '150x83'; ?>
                                            <?php if ( $logo ) : ?>
                                                <?php echo wp_get_attachment_image( $logo, $size ); ?>
                                            <?php endif; ?>
                                        </a>
                                        <p class="text-12 font-italic"><?php the_field( 'footer_text', 'option' ); ?></p>
                                        <?php echo custom_button_styling(get_field( 'button_styling_footer', 'option' ), 'btn-'. get_field_object( 'button_footer', 'option' )['key'], get_field( 'button_footer', 'option' ), get_field( 'enable_custom_button_styling_footer', 'option' ), 'btn-secondary btn-block', 'footer--donate-btn', ''); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row justify-content-lg-between">
                        <div class="col-lg-auto d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start z">
                            <p class="mb-0 mr-lg-2"><?php the_field( 'copyright_text', 'option' ); ?></p>
                            <?php $cards_image = get_field( 'cards_image', 'option' ); ?>
                            <?php $size = 'medium'; ?>
                            <?php if ( $cards_image ) : ?>
                                <?php echo wp_get_attachment_image( $cards_image, $size ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-auto">
                            <?php if ( have_rows( 'links', 'option' ) ) : ?>
                            <ul class="foot-menu d-flex list-unstyled justify-content-center justify-content-lg-end">
                                <?php while ( have_rows( 'links', 'option' ) ) : the_row(); ?>
                                <?php $link = get_sub_field( 'link' ); ?>
                                <li><a href="<?php echo esc_url( $link); ?>"><?php the_sub_field( 'label' ); ?></a></li>
                                <?php endwhile; ?>
                            </ul>                            
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
            <div class="footer-marquee position-relative">
                <div class="marquee d-flex align-items-center" style="background-color: <?php the_field( 'marquee_background_color', 'option' ); ?>;">
                    <div class="track">
                        <div class="track-line">
                            <p class="mb-0">
                            <?php if ( have_rows( 'banner_marquee', 'option' ) ) : ?>
                                <?php while ( have_rows( 'banner_marquee', 'option' ) ) : the_row(); ?>
                                    <?php if ( get_sub_field( 'big_text' ) == 1 ) : ?>
                                        <span class="text-lg d-inline-block mx-4 font-weight-bold" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php else : ?>
                                        <span class="d-inline-block mx-4" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ( have_rows( 'banner_marquee', 'option' ) ) : ?>
                                <?php while ( have_rows( 'banner_marquee', 'option' ) ) : the_row(); ?>
                                    <?php if ( get_sub_field( 'big_text' ) == 1 ) : ?>
                                        <span class="text-lg d-inline-block mx-4 font-weight-bold" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php else : ?>
                                        <span class="d-inline-block mx-4" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ( have_rows( 'banner_marquee', 'option' ) ) : ?>
                                <?php while ( have_rows( 'banner_marquee', 'option' ) ) : the_row(); ?>
                                    <?php if ( get_sub_field( 'big_text' ) == 1 ) : ?>
                                        <span class="text-lg d-inline-block mx-4 font-weight-bold" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php else : ?>
                                        <span class="d-inline-block mx-4" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ( have_rows( 'banner_marquee', 'option' ) ) : ?>
                                <?php while ( have_rows( 'banner_marquee', 'option' ) ) : the_row(); ?>
                                    <?php if ( get_sub_field( 'big_text' ) == 1 ) : ?>
                                        <span class="text-lg d-inline-block mx-4 font-weight-bold" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php else : ?>
                                        <span class="d-inline-block mx-4" style="color:<?php the_sub_field( 'font_color' ); ?>"><?php the_sub_field( 'text' ); ?></span>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            </p> 
                        </div>
                    </div>
                </div>
            </div><!--footer-marquee-->
            </div>
        </footer>
        <!-- /footer -->

	</div>
    <!-- /wrapper-inner -->
</div>
<!-- /wrapper -->
<?php if ( get_field( 'disable_modal', 'option' ) != 1) : ?>
		<!-- Modal -->
			<div class="modal fade signup-modal mt-4" id="blockContentModal" tabindex="-1" aria-labelledby="signUpModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<div class="row m-0 align-items-center">
							<div class="col-lg-6 p-0 d-flex img-modal">
								<?php $image_background = get_field( 'image_background', 'option' ); ?>
								<?php $size = '798x798'; ?>
								<?php if ( $image_background ) : ?>
									<?php echo wp_get_attachment_image( $image_background, $size ); ?>
								<?php endif; ?>
							</div>
							<div class="col-lg-6 alignment-modal">
								<div class="modal-content-right">
									<h3 class="h3 text-uppercase"><span class="title-selected sec"><?php the_field( 'modal_heading', 'option' ); ?></span></h3>
									<?php the_field( 'modal_content', 'option' ); ?>
									<?php $form_modal = get_field( 'forms', 'option' ); ?>
                                    <?php if ( get_field( 'enable_embedded_form_modal', 'option' ) == 1 ) : ?>
                                        <div class="klaviyo-popup">
                                            <?php the_field( 'embedded_form_code', 'option' ); ?>
                                        </div>
                                    <?php else : ?>
                                        <?php if ( $form_modal ) : 
                                            $formID = $form_modal['id'];    
                                        ?>
                                        <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
									    <?php endif; ?>
                                    <?php endif; ?>
									<a href="#" class="" data-dismiss="modal" aria-label="Close">No, thank you</a>
								</div>
							</div>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		<!-- Modal --->	
	<?php endif; ?>
<?php wp_footer(); ?>
<?php the_field( 'footer_script', 'option' ); ?>
<style>
    .blog-category-section h1{
        font-size:<?php the_field( 'category_heading_size', 'option' ); ?>px!important;
        color:<?php the_field( 'category_heading_color', 'option' ); ?>!important;
    }
</style>
</body>
</html>
