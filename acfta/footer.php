<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACFTA
 */
?>
		<!-- footer -->
		<footer class="footer  bg-primary text-white">
            <div class="footer-subscribe">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-auto text-center text-md-left">
                            <h1 class="mb-0">Subscribe to <br> our mailing list</h1>
                        </div>
                        <div class="col-md-auto d-flex">
                        <?php $signup_link = get_field( 'signup_link', 'option' ); ?>
                            <?php if ( $signup_link ) : ?>
                            <a class="btn btn-light btn-block d-flex align-items-center text-center justify-content-center" href="<?php echo esc_url( $signup_link['url'] ); ?>" target="<?php echo esc_attr( $signup_link['target'] ); ?>">Stay in touch</a>
                         <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-widget-area">
                <div class="container">
                    <div class="row justify-content-md-between justify-content-center">
                        <div class="col-md-4 col-xl-2 mb-md-0 mb-5">
                            <div class="footer-logo mb-0">
                             <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 1") ) : ?><?php endif;?>
                             </div>
                        </div>                        
                        <div class="col-7 col-sm-6 col-md-3 col-xl-2 order-xl-1 align-items-end align-items-xl-start">
                            <?php if ( have_rows( 'icons_and_links', 'option' ) ) : ?>
                            <ul class="social-list list-unstyled d-flex mb-0 flex-wrap flex-xl-nowrap justify-content-between w-100">
                                <?php while ( have_rows( 'icons_and_links', 'option' ) ) : the_row(); ?>
                                    <?php $link = get_sub_field( 'link' ); ?>
                                    <li class="ml-0"><a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank"><span class="<?php the_sub_field( 'icon' ); ?>"></span></a></li>
                                <?php endwhile; ?>
                            </ul>
                            <?php endif; ?>
                            
                            <div class="btn-partner-area row">
                                <?php $partner_with_us_footer_link = get_field( 'partner_with_us_footer_link', 'option' ); ?>
                                <?php if ( $partner_with_us_footer_link ) : ?>
                                <a href="<?php echo esc_url( $partner_with_us_footer_link['url'] ); ?>" target="<?php echo esc_attr( $partner_with_us_footer_link['target'] ); ?>" class="btn-light btn-partner"><?php echo esc_html( $partner_with_us_footer_link['title'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-8 col-12 mt-xl-0 mt-5">
                            <div class="row">
                                <div class="col-md col-12 text-md-left text-center mb-4 mb-md-0">
                                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 2") ) : ?><?php endif;?>
                                </div>
                                <div class="col-md col-12">
                                    <div class="footer-widget--links">
                                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 3") ) : ?><?php endif;?>
                                    </div>
                                </div>
                                <div class="col-md col-12">
                                    <div class="footer-widget--links">
                                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer 5") ) : ?><?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copy">
                <div class="container"><?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar("Copyright Text") ) : ?><?php endif;?></div>
            </div>
        </footer>
        <!-- /footer -->
    </div>
    <!-- /wrapper-inner -->
    <div class="footer-wrapper-acknowledgement d-flex align-items-center animate-children" role="dialog">
        <div class="container-xl" role="document">
            <div class="page-content col-md-10 col-lg-8">
                <div class="mobile-space text-20">
                    <?php echo get_field( 'acknowledgement', 'options' ); ?>
                </div>
            </div>
        </div>
    </div><!-- /footer-wrapper-acknowledgement -->
    <div class="footer-wrapper-acknowledgement d-flex align-items-center animate-children" role="dialog">
        <div class="container-xl" role="document">
            <div class="page-content col-md-10 col-lg-8">
                <div class="mobile-space text-20">
                    <?php echo get_field( 'acknowledgement', 'options' ); ?>
                </div>
            </div>
        </div>
     </div><!-- /footer-wrapper-acknowledgement -->

     <!-- mobile-menu -->
     <div class="mobile-menu px-0 py-3">
        <div class="container">
            <div class="mobile-menu__top-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-8 col-md-5">
                        <a class="logo w-100" href="<?php echo site_url(); ?>">
                            <?php $logo = get_field( 'logo_white', 'option' ); ?>
                            <?php $logo_size = 'full'; ?>
                            <?php echo wp_get_attachment_image( $logo, $logo_size ); ?>
                        </a>
                    </div>
                    <div class="col-4 d-flex px-2 align-items-center justify-content-end">
                        <button class="btn-reset header-search px-2"><span class="icon-search"></span></button>
                        <button class="btn-reset menu-toggle m-0 m-lg-3 px-1"><span class="icon-cancel"></span></button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu__menu-links">
                <?php 
                    wp_nav_menu( array(
                        'menu'        => 'Header Menu',
                        'container'   => false,
                        'menu_class'  => 'list-unstyled',
                        'walker'      => new mobile_menu_Walker(),
                    ) );
                ?>
            </div>
            <div class="mobile-menu__social-media mt-5 py-3">
                <?php if ( have_rows( 'icons_and_links', 'option' ) ) : ?>
                <ul class="social-list list-unstyled d-flex mb-0 flex-wrap flex-xl-nowrap justify-content-center w-100">
                    <?php while ( have_rows( 'icons_and_links', 'option' ) ) : the_row(); ?>
                        <?php $link = get_sub_field( 'link' ); ?>
                        <li class="mx-3"><a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank"><span class="<?php the_sub_field( 'icon' ); ?>"></span></a></li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /mobile-menu-->
</div>



<!-- /wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php wp_footer(); ?>
<script type="text/javascript">
	function setCookie(cname, cvalue, exdays) {
	  const d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  let expires = "expires="+ d.toUTCString();
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
	  let name = cname + "=";
	  let ca = document.cookie.split(';');
	  for(let i = 0; i < ca.length; i++) {
	    let c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1);
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length);
	    }
	  }
	  return "";
	}
</script>
<!-- search modal -->
<?php do_action("_acfta_modal") ?>
<?php the_field( 'footer_script', 'option' ); ?>
<?php if( get_field( 'custom_script', get_the_ID() ) ): ?>
<script type="text/javascript">
    <?php echo get_field( 'custom_script', get_the_ID() ); ?>
</script>
<?php endif; ?>
<?php echo get_field( 'footer_code', get_the_ID() ); ?>
</body>
</html>
