<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Livin
 */

$headerClass = !empty($args['class']) ? $args['class']:'secondary-bg';
$textColor = !empty($args['textColor']) ? $args['textColor']:'text-white';
$bannerImage = isset($args['banner']) ? $args['banner'] : '';
$breadcrumbs = $args['breadcrumbs'];
$breadcrumbs_color = $headerClass == 'white-header' ? '':'white';
$bgorange = "";
$bodyClass = !empty($args['bodyClass']) ? $args['bodyClass']:'';
$bannerFeaturedImage = isset($args['banner_featured_image']) ? $args['banner_featured_image'] : false;

if(has_post_thumbnail() && !is_single() && !is_archive() && !is_home() && !is_search() && !is_page_template( 'template-parts/blog_page_template.php' )){
    $headerClass = 'white header-cover-inner-page';
    $textColor = "text-white";
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
    $bannerImage =  esc_url($featured_img_url);
}
$noFeatureImg = "";
if(is_archive() || is_home() || is_page_template( 'blog_page_template.php' ) || is_search()){
   $textColor = $breadcrumbs_color = $headerClass = ""; 
   $noFeatureImg = 1;
}

if( has_post_thumbnail() && is_page() && !is_page_template( 'template-parts/blog_page_template.php' ) ) {
    $bodyClass = 'landing-page '. $bodyClass;
    $headerClass = 'header-cover secondary-bg text-white';
}

if( is_page() && !has_post_thumbnail() && !is_front_page() ) {
    $headerClass = '';
}

$bgColor = '';

if(!empty(get_field('header_background_color')) || is_404()){
    $bgColor = 'secondary-bg text-white';
    $breadcrumbs = "";
    $bgorange =1;
    $bannerImage =  '';
    $textColor = $breadcrumbs_color = $headerClass = ""; 
}

$user_agent = getenv("HTTP_USER_AGENT");
if(strpos($user_agent, "Win") !== FALSE) {
    $os = "os-windows";
}
elseif(strpos($user_agent, "Mac") !== FALSE) {
    $os = "os-mac";
}else{
    $os = "os-others";
}


$bodyClass = $bodyClass .' '. $os;

$livin_cookie = false;
if( isset( $_COOKIE['livin_modal'] ) || $_COOKIE['livin_modal'] == 1 ) {
    $livin_cookie = true;
}

?>
<?php if ( get_field( 'has_dark_background_color' ) == 1 ) : ?>
    <style>
        .header-nav > ul > li > a:hover{
            color:<?php the_field( 'select_hover_color', $post->ID); ?>!important;
        }
    </style>
<?php elseif ( get_field( 'enable_min_height_800' ) == 1 ) : ?>
    <style>
            .header-cover{
                min-height: 918px!important;
                background-position-y: 120px!important;
                background-color: #cdcbe3!important;
                background: no-repeat;
                background-size:contain!important;
            }
            @media only screen and (min-width: 1601px) {
                .header-cover{
                   min-height: 1134px!important;
                   background-position-y: 130px!important;
                }
            }
            a.link-banner {
                width: 100%;
                display: block;
                position: absolute;
                left: 0;
                right: 0;
                height: 100%;
            }
    </style>
<?php else : ?>
    <style>
        .header-nav > ul > li > a:hover{
        color:<?php the_field( 'hover_header_main_menu_color_option', 'option' ); ?>!important;
        }

        .mm-shop-menus .nav a:hover{
            color:<?php the_field( 'hover_header_main_sub_menu_color_option', 'option' ); ?>!important;
        }
        
    </style>
<?php endif; ?>   
<?php if ( get_field( 'page_custom_header_setting' ) == 1 ) : ?>
    <style>
        <?php if ( get_field( 'enable_video_header_banner' ) != 1 ) : ?>
        .header-top{
            background-color:<?php the_field( 'header_custom_background_color' );?>;
            color:<?php the_field( 'header_text_color' ); ?>;
        }
        <?php endif; ?>
        .header-nav > ul > li > a:hover{
            color:<?php the_field( 'header_text_hover_color' ); ?>!important;
        }
        a.custom-donate-btn.btn-primary {
            background-color:<?php the_field( 'donate_button_custom_background_color' ); ?>!important;
        }
    </style>
<?php endif; ?>
<?php if ( get_field( 'enable_header_buttons' ) == 1 ) : ?>
    <style>
        @media only screen and (max-width: 1300px) {
            .header-cover {
                min-height: 800px!important;
            }
        }
        @media only screen and (max-width: 1024px) {
            .header-cover {
                min-height: 666px!important;
            }
        }

        @media only screen and (max-width: 768px) {

            .header-cover {
                min-height: 530px!important;
            }
        }
        
        @media only screen and (max-width: 600px) {
            .header-cover {
                min-height: 440px!important;
            }
        }

        @media only screen and (max-width: 420px) {
            .header-cover {
                min-height: 320px!important;
            }
        }

        @media only screen and (max-width: 320px) {
            .header-cover {
                min-height: 290px!important;
            }
        }
    </style>
<?php endif; ?>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

    <?php the_field( 'head_script', 'option' ); ?>
</head>

<body <?php body_class( $bodyClass ); ?>>
<?php the_field( 'body_script', 'option' ); ?>
<?php wp_body_open(); ?>
<!-- wrapper -->
<div class="wrapper <?php the_field( 'class',$post->ID); ?>">
    <!-- wrapper-inner -->
    <div class="wrapper-inner">
		<!-- header -->
        <?php if ( get_field( 'enable_video_header_banner' ) == 1 ) : ?>
            <header class="header header-video-cover text-white">
            <div class="video-background">
                <div class="video-foreground">
                    <?php the_field( 'video_embed_code' ); ?>
                </div>
            </div>
        <?php else : ?>
            <header class="header <?php if ( get_field( 'has_header_content_banner') == 1 ) : ?>no-banner-header <?php endif; ?><?php echo $bgColor;?> <?php if ( is_front_page() || is_single() || has_post_thumbnail() || is_page( array('contact'))){ echo $headerClass. ' ' .$textColor; }?>" style="<?php if( !empty($bannerImage) ){ echo 'background-image: url('. $bannerImage .')'; } ?>">
                <?php if ( get_field( 'overlap_banner_to_content' ) == 1  && !is_search()) : ?>
                    <div class=" header-top header-top-absolute">
                <?php else : ?>
                    <div class="header-top">
                    <?php if ( get_field( 'enable_header_buttons' ) == 1 ) : ?>
                        <?php if ( have_rows( 'buttons' ) ) : ?>
	                    <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                        <?php $button_link = get_sub_field( 'button_link' ); ?>
		                <?php if ( $button_link ) : ?>
                            <a id="enable_header_buttons" class="btn btn-primary unstyled " href="<?php echo esc_url( $button_link['url'] ); ?>" target="<?php echo esc_attr( $button_link['target'] ); ?>">
                            <?php echo esc_html( $button_link['title'] ); ?>
                                <style type="text/css">
                                #enable_header_buttons{color: <?php the_sub_field( 'button_text_color' ); ?>!important;background-color: <?php the_sub_field( 'button_color' ); ?> !important;border-color: <?php the_sub_field( 'button_color' ); ?> !important;}
                                #enable_header_buttons:hover{color: <?php the_sub_field( 'button_text_hover' ); ?>!important;background-color: <?php the_sub_field( 'button_background_hover' ); ?>!important;border-color: <?php the_sub_field( 'button_background_hover' ); ?> !important;}
                                </style>
                            </a>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
        <?php endif; ?> 
                <div class="container <?php if ( get_field( 'enable_video_header_banner' ) == 1 ) : ?> header-top<?php endif; ?> ">
                    <div class="row align-items-center">
                         <div class="col-auto d-xl-none">
                            <a href="#" class="menu-toggle js-menu-toggle">
                                <?php if ( get_field( 'white_burger_menu', $post->ID ) == 1 || get_field( 'page_custom_header_setting' ) == 1) : ?>
                                    <span class="icon-menu text-white"></span>
                                <?php else : ?>
                                    <span class="icon-menu"></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="col-auto">                       
                            <?php if ( (is_front_page() || $bannerFeaturedImage || is_page( array('contact')) || get_field( 'enable_white_logo' ) == 1 ||(has_post_thumbnail() && !is_single()) ) && !$noFeatureImg  || get_field( 'overlap_banner_to_content' ) == 1 && !is_search()) : ?>
                                <?php  the_custom_logo();  ?>
                            <?php elseif ($bgorange) : ?>
                                <?php  the_custom_logo();  ?>  
                            <?php elseif(is_search()): ?>  
                                <a class="header-logo logo" href="<?php echo site_url(); ?>">
                                <img src="<?php the_field( 'logo_internal_page', 'option' ); ?>" />
                                </a>
                            <?php else:?>
                                <a class="header-logo logo" href="<?php echo site_url(); ?>">
                                    <img src="<?php the_field( 'logo_internal_page', 'option' ); ?>" />
                                </a>
                            <?php endif;?>
                        </div>
                       
                        <div class="col d-none d-xl-block">
                            <nav class="header-nav">
								<?php
                                      my_nav_menu_jm('menu-1');
								?>
                            </nav>
                        </div>
                        <div class="col-auto ml-auto d-flex align-items-center">
                            <div class="d-none d-lg-block position-relative" style="">
                                <button class="btn-search btn-reset"><span class="icon-search"></span></button>
                                <div class="search-form">                                   
                                    <form action="/" class="" method="get">
                                        <input type="search" class="form-control mb-0"  name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search...">
                                        <button type="submit" class="search-button"><span class="icon-search"></span></button>
                                    </form>
                                </div>
                            </div>
                            <?php if ( get_field( 'enable_donate_button_custom_styling' ) == 1 ) : ?>
                            <?php   $anchor = get_field( 'header_button', 'option' ); ?>
                                <a href="<?php echo $anchor['url'];?>" target="<?php echo $anchor['target']; ?>" class="custom-donate-btn btn btn-primary"><?php echo $anchor['title'];?></a>
                            <?php else : ?>
                             <?php 
                                $button = get_field( 'header_button', 'option' ); 
                                $button_styles = get_field( 'button_styling', 'option' );
                                $button_id = get_field_object( 'header_button', 'option' )['key'];
                                $enable_button_styling = get_field( 'enable_custom_button_styling', 'option' );
                                $btn_class = 'btn-primary';

                                if( get_field( 'enable_custom_button_styling', $post->ID ) == 1 ) {
                                    $button_styles = get_field( 'button_styling', $post->ID );
                                    $enable_button_styling = get_field( 'enable_custom_button_styling', $post->ID );
                                }
                            ?>
                            <?php 
                                $urlPage = $_SERVER['REQUEST_URI']; 
                                $urlPage = rtrim( $urlPage, '/' );
                                $anchor = (strpos( $button['url'], $urlPage ) !== false) ? get_field( 'button_anchor', 'option' ) : '';
                            ?>
                            <?php echo custom_button_styling($button_styles, $button_id, $button, $enable_button_styling, $btn_class, $anchor); ?>
                            <?php endif; ?>
                        </div>
                        
                       
                    </div>
                </div>
            </div>

            <?php if( ($breadcrumbs && empty(get_field('disable_breadcrumb'))) || is_archive() || get_field( 'overlap_banner_to_content' ) == 1 && !is_search()): ?>
                <div class="<?php if ( get_field( 'page_custom_header_setting' ) == 1 ) : ?>d-none<?php endif;?> border-top border-bottom <?php if(get_field( 'overlap_banner_to_content' ) == 1):?>breadcrumb-overlap<?php endif;?>">
                    <div class="container animate-children">
                        <nav aria-label="breadcrumb" class="position-relative breadcrumb-nav">
                            <?php #yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>'); ?>
                            <?php doublee_breadcrumbs($breadcrumbs_color);?>
                        </nav>
                    </div>
                </div>
            <?php elseif(is_search()):?>
                <div class="border-top border-bottom search-result">
                    <div class="container animate-children">
                        <nav aria-label="breadcrumb" class="position-relative breadcrumb-nav">                          
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><span><span><a href="/">Home</a> </span></span></li>
                                <li><span class="breadcrumb-line"></span></li> 
                                <li class="breadcrumb-item active" aria-current="page"><span>Search Results</span></li>
                            </ol>                       
                        </nav>
                    </div>
                </div>
            <?php elseif(is_home()):?>
                <div class="border-top border-bottom search-result">
                    <div class="container animate-children">
                        <nav aria-label="breadcrumb" class="position-relative">                          
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><span><span><a href="/">Home</a> </span></span></li>
                                <li><span class="breadcrumb-line"></span></li> 
                                <li class="breadcrumb-item active" aria-current="page"><span>Blog Search</span></li>
                            </ol>                       
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
            
             <?php if ( get_field( 'enable_header_link' ) == 1 ) : ?>
                <?php $header_link = get_field( 'header_link' ); ?>
                <?php if ( $header_link ) : ?>
                    <a class="link-banner" href="<?php echo esc_url( $header_link['url'] ); ?>" target="<?php echo esc_attr( $header_link['target'] ); ?>"></a>
                <?php endif; ?>
            <?php endif; ?>
        </header>
        <!-- /header -->