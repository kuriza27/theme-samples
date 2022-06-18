<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACFTA
 */
$pageID ="";
 if(!empty($post->ID)){
    $pageID = $post->ID;
 }

$headerColor = get_field( 'header_color',$pageID);
if ( is_post_type_archive() || is_search()) {
    $logo = get_field( 'logo_black', 'option' );
	$colorClass = '';
}else{
    if ( $headerColor == 'white') {
        $logo = get_field( 'logo_white', 'option' );
        $colorClass = 'text-white';
    }
    else {
        $logo = get_field( 'logo_black', 'option' );
        $colorClass = '';
    }
}

if(!empty($post->post_password) && post_password_required()){
    $logo = get_field( 'logo_black', 'option' );
	$colorClass = '';
 }

$size = 'full';

$bodyClassOption = get_field( 'body_class', $pageID);
$body_class = '';

if( !(is_search()) ) {
    $body_class .= $bodyClassOption;
}
if(is_post_type_archive()){
    $body_class .= ' archive-page-template'; 
}
if(is_single()){
    $body_class .= ' blog-page header';
} elseif(is_search()){
    $body_class .= ' search-page';
}

$acknowledgement_cookie = false;
if( isset( $_COOKIE['acknowledgement_of_country'] ) || $_COOKIE['acknowledgement_of_country'] == 1 ) {
    $acknowledgement_cookie = true;
}

if( !$acknowledgement_cookie ) {
    $body_class .= ' acknowledgement--loading';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<?php wp_head(); ?>
    <?php the_field( 'head_script', 'option' ); ?>
    <?php if( get_field( 'custom_css', get_the_ID() ) ): ?>
    <style type="text/css">
        <?php echo get_field( 'custom_css', get_the_ID() ); ?>
    </style>
    <?php endif; ?>
    <?php echo get_field( 'head_code', get_the_ID() ); ?>
</head>

<body <?php body_class($body_class);?>>
<?php the_field( 'body_script', 'option' ); ?>
<?php if( !$acknowledgement_cookie ): ?>
<div class="acknowledgement--backdrop"></div>
<?php endif; ?>
<?php echo get_field( 'body_code', get_the_ID() ); ?>
<?php wp_body_open(); ?>
<!-- wrapper -->
<div class="wrapper">
    <!-- wrapper-inner -->
    <div class="wrapper-inner">
		<!-- header -->
        <header class="header bg-cover position-absolute w-100 <?php echo $colorClass; ?> <?php echo get_field( 'header_class', $pageID); ?>">
            <div class="header-top">
				<?php if ( !isset($_COOKIE['covid_alert']) and get_field( 'show_notification_bar', 'option' ) == 1 ) : ?>
                   <div class="alert alert-covid alert-primary alert-dismissible fade show" role="alert">
                    <div class="container position-relative d-flex align-items-center">
                        <span class="i-icon flex-shrink-0 align-self-start">i</span>
                            <span><?php the_field( 'notification_bar', 'option' ); ?></span>
                        <button type="button" class="close <?php if ( get_field( 'hide_notification_close_button', 'option' ) == 1 ) : ?>d-none<?php endif; ?> alert-close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><span class="icon-cancel"></span></span>
                            </button>
                        </div>
                    </div>
				<?php endif; ?>
                <div class="container">
                    <div class="row align-items-center justify-content-between">                        
                        <div class="col-8 col-md col-lg-auto">
                           <a class="logo" href="<?php echo site_url(); ?>">
                                <?php $logo_size = 'full'; ?>
								<?php echo wp_get_attachment_image( $logo, $logo_size, false, array( 'class' => 'logo--white' ) ); ?>
                                <?php echo wp_get_attachment_image( get_field( 'logo_black', 'option' ), $logo_size, false, array( 'class' => 'd-none logo--black' ) ); ?>
							</a>
                        </div>
                        <div class="col-auto order-xl-2 d-flex d-lg-block align-items-center">
                            <div class="px-0 d-lg-none">
                                <button class="btn-reset header-search"><span class="icon-search"></span></button>
                            </div>
                            <div class="">
                                <button class="btn-reset header-search d-none d-lg-inline"><span class="icon-search"></span>
                                </button>
                                <button class="btn-reset menu-toggle m-0 m-lg-3"><span class="icon-menu"></span></button>
                                <a data-toggle="tooltip" data-placement="left" title="Log in to the Application Management System." href="https://australiacouncil.fluxx.io/user_sessions/new" target="_blank" class="btn-login d-none d-md-inline-block d-lg-inline-block">Login</a>
                            </div>
                        </div>
                        <div class="col-12 col-lg d-none d-xl-block nav-container">
                            <nav class="header-nav alt">
                                <?php 
                                    wp_nav_menu( array(
                                        'menu'        => 'Header Menu',
                                        'container'   => false,
                                        'menu_class'  => 'list-unstyled d-flex align-items-end justify-content-between justify-content-xl-end',
                                        'walker'      => new main_menu_Walker(),
                                    ) );
                                ?>  
                            </nav>
                        </div>

                    </div>
                    <!-- mega menu -->
                    <?php do_action("acfta_mega_menu") ?>

                </div>
            </div>
            <?php if ( get_field( 'no_banner' ) == 1 ) : ?>
                <div class="breadcrumb-container mt-4 mobile-space border-top-light">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <?php yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>'); ?>
                            <span class="breadcrumb--scroller"><span class="icon-right"></span></span>
                        </nav>
                    </div>
                </div>
                <div class="page-content page-header-block" style="color:#000;background-color:#fff;">
                    <div class="social-share-block">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <!--<ul class="share-list list-unstyled d-flex mb-0 justify-content-end">
                                        <li><a href="#"><span class="icon-share-2"></span></a></li>
                                        <li><a href="#"><span class="icon-email"></span></a></li>
                                        <li><a href="#"><span class="icon-plus"></span></a></li>
                                    </ul>-->
                                    <?php echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </header>
        <!-- /header -->
