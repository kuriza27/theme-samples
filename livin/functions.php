<?php
/**
 * Livin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Livin
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'livin_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function livin_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Livin, use a find and replace
		 * to change 'livin' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'livin', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'livin' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'livin_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'livin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function livin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'livin_content_width', 640 );
}
add_action( 'after_setup_theme', 'livin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function livin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'livin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'livin' ),
			'before_widget' => '<div id="%1$s" class="widget-s %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'livin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function livin_scripts() {
	wp_enqueue_style( 'livin-style', get_stylesheet_uri(), array(), '2.5.6' );
	wp_style_add_data( 'livin-style', 'rtl', 'replace' );

	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/custom.min.js', array(), '2.0.5' );
	wp_register_script( 'js-cookie', get_template_directory_uri() . '/js/js_cookie.min.js', array(), _S_VERSION, true );
	wp_register_script( 'dropkick', get_template_directory_uri() . '/js/dropkick.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'livin_scripts' );

/**
 * WIDGETS.
 */
require get_template_directory() . '/inc/widgets.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Pagination Customization
 */

require get_template_directory() . '/inc/pagination.php';
 

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * ACF Options Page
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

/**
 * ACF Options Page Title
 */
if( function_exists('acf_set_options_page_title') ) {
    acf_set_options_page_title( __('Theme Options') );
}

/**
 * Register ACF Blocks
 */
require get_template_directory() . '/inc/acf.php';

/**
* Add custom image specific sizes
*/
add_image_size('32x32', 32, 32);
add_image_size('220x56', 220, 56);
add_image_size('867x795', 867, 795);
add_image_size('690x612', 690, 612);
add_image_size('235x40', 235, 40);
add_image_size('298x212', 298, 212,true);
add_image_size('402x266', 402, 266,true);
add_image_size('402x420', 402, 420,true);
add_image_size('798x798', 798, 798);
add_image_size('117x117', 117, 117, true);
add_image_size('177x177', 177, 177);
add_image_size('150x83', 150, 83);
add_image_size('1920x826', 1920, 826);
add_image_size('517x246', 517, 246);
add_image_size('238x298', 238, 298);
add_image_size('ZC_238x298', 238, 298, true);


// function filter_breadcrumbs($link_output, $link) {
// 	$link_output = preg_replace("/<span\s(.+?)>(.+?)<\/span>/is", "<li class='breadcrumb-item active' $1><span>$2</span></li>", $link_output);
// 	return $link_output;
// }
// add_filter('wpseo_breadcrumb_single_link', 'filter_breadcrumbs', 10, 2);

/**
 * shove YOAST settings panel in editor to bottom 
 */
add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );

/**
 * Mega menu walker nav
 */
require get_template_directory() . '/inc/mega-menu-walker.php';
function my_nav_menu_jm($name = null) {
    $myMenu = new my_custom_menu($name);
    $myMenu->draw();
} 

function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );




/**
 * Custom Breadcrumb output using Yoast Breadcrumb
 */
function doublee_filter_yoast_breadcrumb_items( $link_output, $link ) {

	
	// if(has_category('',$link['id']) && is_single()){
		
	// 	$category_detail = get_the_category( $link['id'] );
	// 	$new_link_output = "";

	// 	$new_link_output .= '<li class="breadcrumb-item">';
	// 	$new_link_output .= '<a href="/blog/" >Blog</a>';
	// 	$new_link_output .= '</li>';
		
	// 	if($category_detail[0]->parent){
	// 		$catParentLink = get_category_link($category_detail[0]->parent);
	// 		$catParentName = get_cat_name($category_detail[0]->parent);

	// 		$new_link_output .= '<li><span class="breadcrumb-line"></span></li><li class="breadcrumb-item">';
	// 		$new_link_output .= '<a href="' . $catParentLink . '" >' . $catParentName . '</a>';
	// 		$new_link_output .= '</li>';

	// 	}
		
	// 	$catLink = get_category_link($category_detail[0]->term_id);
	// 	$catName = $category_detail[0]->name;

	// 	$new_link_output .= '<li><span class="breadcrumb-line"></span></li><li class="breadcrumb-item">';
	// 	$new_link_output .= '<a href="' . $catLink . '" >' . $catName . '</a>';
	// 	$new_link_output .= '</li>';


	// 	$new_link_output .= '<li><span class="breadcrumb-line"></span></li><li class="breadcrumb-item">';
	// 	$new_link_output .= '<a href="' . $link['url'] . '" >' . $link['text'] . '</a>';
	// 	$new_link_output .= '</li>';

		
		
	// }else{
		$new_link_output = '<li class="breadcrumb-item">';
		$new_link_output .= '<a href="' . $link['url'] . '" >' . $link['text'] . '</a>';
		$new_link_output .= '</li>';
	//}
	

	return $new_link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'doublee_filter_yoast_breadcrumb_items', 10, 2 );


function doublee_filter_yoast_breadcrumb_output( $output ){

	$from = '<span>';
	$to = '</span>';
	$output = str_replace( $from, $to, $output );

	return $output;
}
add_filter( 'wpseo_breadcrumb_output', 'doublee_filter_yoast_breadcrumb_output' );


function doublee_breadcrumbs($breadcrumbs_color) {
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<ol class="breadcrumb '. $breadcrumbs_color .'"><li class="breadcrumb-item">','</li></ol>');
	}
}

/**
 * Allow SVG Upload
 */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
  }
  add_action( 'admin_head', 'fix_svg' );

/**
 * Custom Button Styling
 */
function custom_button_styling($button_styles, $button_id, $button, $enabled, $btn_class = '', $parent = '', $anchor = '') {

	$global_enabled = get_field( 'enable_global_button_styling', 'option' );		
	$custom_enabled = true;
	$unstyled = '';
	$parent = ( $parent != '' ) ? '#'. $parent .' ' : '';

	if( $enabled == 1 ) {
		$styles = $button_styles;
	} elseif( $global_enabled == 1 ) {
		$styles = get_field( 'global_button_styling', 'option' );
	} else {
		$custom_enabled = false;
	}

	if( $custom_enabled ) {
		$text_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
		$bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
		$border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
		$hover_text_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
		$hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
		$hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
		$button_classes = $styles['custom_button_classes'];

		$styling = $parent .'#'. $button_id .'{'. $text_color . $bg_color . $border_color .'}';
		$styling .= $parent .'#'. $button_id .':hover{'. $hover_text_color . $hover_bg_color . $hover_border_color .'}';
		$unstyled = 'unstyled';

		if( strpos( $btn_class, 'psuedo-before' ) !== false ) {
			$styling .= $parent .'#'. $button_id .':before{'. $text_color . $bg_color . $border_color .'}';
			$styling .= $parent .'#'. $button_id .':hover:before{'. $hover_text_color . $hover_bg_color . $hover_border_color .'}';
		}
		
		$render_style = '<style type="text/css">'. $styling .'</style>';		
	}

	$classes = $btn_class .' '. $unstyled .' '. $button_classes;

	if( $button ) {
		$render = '<a id="'. $button_id .'" class="btn '. $classes .'" href="'. esc_attr( $button['url'] ) . $anchor .'" target="'. esc_attr( $button['target'] ) .'">'. esc_html( $button['title'] ) . $render_style .'</a>';
	} else {
		$render = '';
	}

	return $render;
}

add_filter('wpseo_metadesc', 'custom_metadesc');

function custom_metadesc( $desc ) {
	if ( $_SERVER['REQUEST_URI'] == "/blog/upcoming-events/" ) {
        $desc = "Keep up with everything happening at LIVIN! For all your LIVINWell and LIVIN upcoming events click here!";
    }

    return $desc;
}