<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Livin
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function livin_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'livin_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function livin_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'livin_pingback_header' );

/**** CUSTOM FUNCTIONS */



function shorten_text($text, $max_length = 140, $cut_off = '...', $keep_word = false){
    if(strlen($text) <= $max_length) {
        return $text;
    }

    if(strlen($text) > $max_length) {
        if($keep_word) {
            $text = substr($text, 0, $max_length + 1);

            if($last_space = strrpos($text, ' ')) {
                $text = substr($text, 0, $last_space);
                $text = rtrim($text);
                $text .=  $cut_off;
            }
        } else {
            $text = substr($text, 0, $max_length);
            $text = rtrim($text);
            $text .=  $cut_off;
        }
    }

    return $text;
}


function my_post_time_ago_function() {
	return sprintf( esc_html__( '%s Read', 'textdomain' ), human_time_diff(get_the_time ( 'U' ), current_time( 'timestamp' ) ) );
}

function get_since_dropdown(){

	global $wpdb;

	$sql = "SELECT MONTHNAME(t.post_date) AS `monthname`, YEAR(t.post_date) AS `year`,
   MONTH(t.post_date) AS `monthnum` FROM wp_posts t WHERE t.post_type IN ('post') 
   AND t.post_status ='publish' GROUP BY YEAR(t.post_date) DESC, MONTH(t.post_date) DESC";

	$results = $wpdb->get_results($sql);

	return $results;
}


/**
 * Rewrite WordPress URLs to Include /blog/ in Post Permalink Structure
 *
 * @author   Golden Oak Web Design <info@goldenoakwebdesign.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */

function golden_oak_web_design_blog_generate_rewrite_rules( $wp_rewrite ) {
  $new_rules = array(
   # '(([^/]+/)*blog)/page/?([0-9]{1,})/?$' => 'index.php?pagename=$matches[1]&paged=$matches[3]',
    'blog/([^/]+)/?$' => 'index.php?post_type=post&name=$matches[1]',	
    'blog/[^/]+/attachment/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'blog/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'blog/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',		
    'blog/[^/]+/attachment/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/[^/]+/embed/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/([^/]+)/embed/?$' => 'index.php?post_type=post&name=$matches[1]&embed=true',
    'blog/[^/]+/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/([^/]+)/trackback/?$' => 'index.php?post_type=post&name=$matches[1]&tb=1',
    'blog/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'blog/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'blog/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged=$matches[1]',
    'blog/[^/]+/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'blog/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'blog/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&cpage=$matches[2]',
    'blog/([^/]+)(/[0-9]+)?/?$' => 'index.php?post_type=post&name=$matches[1]&page=$matches[2]',
    'blog/[^/]+/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'blog/[^/]+/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'blog/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',
  );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
#add_action( 'generate_rewrite_rules', 'golden_oak_web_design_blog_generate_rewrite_rules' );

// // Add day archive (and pagination)

// add_rewrite_rule("blog/mental-health/([0-9]{4})/([0-9]{2})/([0-9]{2})/?",'index.php?post_type=mental-health&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]','top');
 
// // Add month archive (and pagination)
// add_rewrite_rule("blog/mental-health/([0-9]{4})/([0-9]{2})/page/?([0-9]{1,})/?",'index.php?post_type=mental-health&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]','top');
// add_rewrite_rule("blog/mental-health/([0-9]{4})/([0-9]{2})/?",'index.php?post_type=mental-health&year=$matches[1]&monthnum=$matches[2]','top');
 
// // Add year archive (and pagination)
// add_rewrite_rule("blog/mental-health/([0-9]{4})/page/?([0-9]{1,})/?",'index.php?post_type=mental-health&year=$matches[1]&paged=$matches[2]','top');
// add_rewrite_rule("blog/mental-health/([0-9]{4})/?",'index.php?post_type=mental-health&year=$matches[1]','top');


// function archive_rewrite_rules() {
//     add_rewrite_rule(
//         '^blog/mental-health/(.*)/(.*)/?$',
//         'index.php?post_type=mental-health&name=$matches[2]',
//         'top'
//     );
    
    
// }

// add_action( 'init', 'archive_rewrite_rules' );



function golden_oak_web_design_update_post_link( $post_link, $id = 0 ) {
  $post = get_post( $id );
  if( is_object( $post ) && $post->post_type == 'post' ) {
    return home_url( '/blog/' . $post->post_name );
  }
  return $post_link;
}
add_filter( 'post_link', 'golden_oak_web_design_update_post_link', 1, 3 );