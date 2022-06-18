<?php
/**
 * ACFTA functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ACFTA
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'noda_acfta_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function noda_acfta_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ACFTA, use a find and replace
		 * to change 'noda_acfta' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'noda_acfta', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'noda_acfta' ),
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
				'noda_acfta_custom_background_args',
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
add_action( 'after_setup_theme', 'noda_acfta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function noda_acfta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'noda_acfta_content_width', 640 );
}
add_action( 'after_setup_theme', 'noda_acfta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function noda_acfta_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'noda_acfta' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'noda_acfta' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'noda_acfta_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function noda_acfta_scripts() {
	wp_enqueue_style( 'bootstrap-multiple-css', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css', array(), _S_VERSION);
	wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap', array(), _S_VERSION );
	wp_enqueue_style( 'noda_acfta-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'noda_acfta-style', 'rtl', 'replace' );

	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'js-cookie', get_template_directory_uri() . '/js/js.cookie.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'bootstrap-multiple-js', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-multiple-js', get_template_directory_uri() . '/js/bootstrap-multiselect.js', array(), time(), true );
	wp_enqueue_script( 'app-js', get_template_directory_uri() . '/js/app.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'app-js', get_template_directory_uri() . '/js/app.js', array(), time(), true );
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/js/custom.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'dropkick', get_template_directory_uri() . '/js/dropkick.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'js-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'methods', get_template_directory_uri() . '/js/additional-methods.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'noda_acfta_scripts' );

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
 * widgets.
 */
require get_template_directory() . '/inc/widgets.php';


/**
 * Mega menu.
 */
require get_template_directory() . '/inc/walker.php';


/**
 * Custom Post Type
 */
require get_template_directory() . '/inc/cpt.php';

function my_nav_menu_jm($name = null) {
    $myMenu = new my_custom_menu($name);
    $myMenu->draw();
} 


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
	// add mega menu acf options
	acf_add_options_page(array(
	    'page_title'    => 'Mega Menu',
	    'menu_title'    => 'Mega Menu',
	    'menu_slug'     => 'theme-mega-menu',
	    'capability'    => 'edit_posts',
	    'redirect'      => TRUE
	));
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
add_image_size('1920x800', 1920, 800);
add_image_size('1190x787', 1190, 787);
add_image_size('1190x766', 1190, 766);
add_image_size('1920x721', 1920, 721);
add_image_size('1024x1024', 1024, 1024);
add_image_size('990x557', 997, 557);
add_image_size('607x650', 607, 650);
add_image_size('447X235', 447, 235, true);
add_image_size('288X411', 288, 411);
add_image_size('375X77', 375, 77);
add_image_size('447X650', 447, 650,true);
add_image_size('453X677', 453, 677);
add_image_size('452X458', 452, 458);
add_image_size('250x120', 250, 120);
add_image_size('300x600', 300, 600);
add_image_size('440x235', 440, 235, true);
add_image_size('685x357', 685, 357, true);
add_image_size('350x600', 350, 600);
add_image_size('566x566', 566, 566);
add_image_size('365x200', 365, 200, true);
add_image_size('732x650', 732, 650, true);
add_image_size('1080x790', 1080, 790, true);
add_image_size('763x384', 763, 384, true);
add_image_size('605x820', 605, 820, true);
add_image_size('605x384', 605, 384, true);
add_image_size('350x350', 350, 350);


/**
 * Custom Breadcrumb output using Yoast Breadcrumb
 */
function filter_breadcrumbs($link_output, $link) {
		$link_output = '<li class="breadcrumb-item">';
		$link_output .= '<a href="' . $link['url'] . '" >' . $link['text'] . '</a>';
		$link_output .= '</li>';
	//$link_output =  "<li class='breadcrumb-item active' aria-current='page' $1>$2</li>", $link_output;
	return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'filter_breadcrumbs', 10, 2);

add_action("acfta_mega_menu", "_show_mega_menu");
function _show_mega_menu(){
	$menu_sections = get_field_object('menu_sections', 'options');
	$total_sections = (count($menu_sections['value']));

	$max = 4;
	$section_width = '95%';
	if( $total_sections > $max ){
		$section_width = '23%';
	}

	include dirname(__FILE__) . '/template-parts/mega-menu.php';
}

add_action("_acfta_modal", "_load_acfta_modals");
function _load_acfta_modals(){
	// search modal
	get_template_part('template-parts/modal/search');

	// search modal
	get_template_part('template-parts/modal/facilitator');

	// acknowledgement of country
	get_template_part('template-parts/modal/acknowledgement-of-country');

	// content modal
	get_template_part('template-parts/modal/content');

}

/**
 * Initialize custom Location Rule: Post Parent for ACF
 */
add_action('acf/init', 'custom_acf_init_location_types');
function custom_acf_init_location_types() {

    if( function_exists('acf_register_location_type') ) {
        include_once( 'inc/acf-location-rule.php' );
        acf_register_location_type( 'ACF_Location_Post_Parent' );
    }
}

/**
 * Custom Pagination
 */
function custom_pagination($wp_query = false) {
	if( !$wp_query ) {
		global $wp_query;
	}
	$big = 999999999; // need an unlikely integer

	ob_start();
	$pagination = paginate_links( array(
		'base' 		=> str_replace( [ $big, '&#038;' ], [ '%#%', '&' ], get_pagenum_link( $big ) ),
		'format' 	=> '?paged=%#%',
		'current' 	=> max( 1, get_query_var('paged') ),
		'total' 	=> $wp_query->max_num_pages,
		'type' 		=> 'array',
		'prev_text' => __('<span class="icon-plus-light"></span> Prev Page', 'pagination'),
		'next_text' => __('Next Page <span class="icon-plus-light"></span>', 'pagination'),
	) );
	if( !empty( $pagination ) ) {
		$count = 0;
		foreach( $pagination as $key => $page_link ) {
			$active = ( strpos( $page_link, 'current' ) !== false ) ? 'active' : '';			
			echo '<li class="page-item '. $active .'">'. str_replace( 'page-numbers', 'page-link', $page_link ) .'</li>';
			if( $wp_query->max_num_pages == $count && get_query_var('paged') > 1 ) {
				echo '<li class="page-item"></li>';
			}

			$count++;
		}
	}
	echo ob_get_clean();
}

remove_action('template_redirect', 'redirect_canonical');

function remove_post_type_page_from_search() {
    global $wp_post_types;
    $wp_post_types['corporate_docs']->exclude_from_search = true;
}
add_action('init', 'remove_post_type_page_from_search');

function filter_the_excerpt( $content ) { 
    $string = htmlentities($content, null, 'utf-8');
	$content = str_replace("&nbsp;", " ", $string);
	$content = html_entity_decode($content); 

	return $content;
};          
add_filter( 'the_excerpt', 'filter_the_excerpt', 10, 2 ); 

function filter_the_title( $content ) { 
    $string = htmlentities($content, null, 'utf-8');
	$content = str_replace("&nbsp;", " ", $string);
	$content = html_entity_decode($content); 

	return $content;
};          
add_filter( 'the_title', 'filter_the_title', 10, 2 );

/**
 * Reading time
 */
require get_template_directory() . '/inc/reading-time-wp.php';