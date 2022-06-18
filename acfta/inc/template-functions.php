<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ACFTA
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function noda_acfta_body_classes( $classes ) {
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
add_filter( 'body_class', 'noda_acfta_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function noda_acfta_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'noda_acfta_pingback_header' );

/**
 * Load Investment Filter/Search
 */
function loadPage(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];

	$template_grid = get_template_directory().'/template-parts/content-post-investment.php';
	$template_list = get_template_directory().'/template-parts/content-post-investment-list.php';
	
	$args = [   
		'post_type' => $postType,
		'post_status' => 'publish',
        'meta_key'	    => 'closing_date',
        'orderby'		=> 'meta_value',
        'order'			=> 'ASC',		
		'posts_per_page' => -1,
		'meta_query'    => array(
			'relation'  => 'AND',
			array(
				'relation'  => 'OR',
				array(
					'key'       => 'exclude_in_archive',
					'compare'   => '!=',
					'value'     => 1,
				),
				array(
					'key'       => 'exclude_in_archive',
					'compare'   => 'NOT EXISTS',
				)
			),
			array(
				'relation'  => 'OR',
				array(
					'key'       => 'closing_date',
					'compare'   => '>=',
					'value'     => date('Y-m-d'),            
					'type'      => 'DATE'
				),
				array(
					'key'       => 'closing_date',
					'compare'   => '<',
					'value'     => date('Y-m-d'),            
					'type'      => 'DATE'
				),
			),
		),     
	];

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}

	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadPage', 'loadPage' );
add_action( 'wp_ajax_nopriv_loadPage', 'loadPage' ); 


function loadResearch(){
	
	$response = [];
	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$view = $_REQUEST['view'];
	
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];

	$args = [   
		'post_type' 		=> $postType,
		'post_status' 		=> 'publish',
		'paged'   			=> $paged,
		'post__not_in'      => array(12005),
		'post_parent'       => 0,
		'posts_per_page' 	=> 12,
		'category__not_in' 	=> 103,       
	];

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}

	$template = get_template_directory().'/template-parts/content-post-types.php';

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	// block view
	$view = "block-view";
	ob_start();
	include($template);
	$block_view = ob_get_contents();
	ob_end_clean();

	// list view
	$view = "list-view";
	ob_start();
	include($template);
	$list_view = ob_get_contents();
	ob_end_clean();

	// reset $view
	$view = $_REQUEST['view'];


	$data = array(
		"total" => $totalpost,
		"entries" => trim($block_view),
		"list_entries" => trim($list_view),
		"view" => $view
	);

	print json_encode($data); 
	exit;  


} 
add_action( 'wp_ajax_loadResearch', 'loadResearch' );
add_action( 'wp_ajax_nopriv_loadResearch', 'loadResearch' );


function custom_loadmore_speeches(){
	$paged = intval($_POST['paged']);
    $cat_id = $_POST['cat_id'];
    $post_type = $_POST['post_type'];
    $posts_per_page = $_POST['posts_per_page'];
    $posts_not_in = $_POST['posts_not_in'];



    $args = array(
        'post_type' => $post_type,
        'paged' => $paged,
        'page' => $paged,
        'post__not_in' => $posts_not_in,
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
	        array(
	            'taxonomy' => 'speech_author',
	            'field'    => 'term_id',
	            'terms'    => array(78), //for adrian
	        ),
	    ),
    );

    ob_start();		
	$the_query = new WP_Query($args);
	$max_num_pages = $the_query->max_num_pages;
    while ( $the_query->have_posts() ) {
        $the_query->the_post(); ?>
            <li>
                <a href="<?php echo get_permalink(); ?>">
                    <h6><?php echo get_the_date( 'd M, Y' );?></h6>
                    <h4> <?php echo get_the_title(); ?></h4>
                </a> 
            </li>
    <?php }
    wp_reset_postdata();
	$var = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"max_num_pages" => $max_num_pages,
		"html" => trim($var),
	);

	print json_encode($data); 
	exit; 

    //die();
}
add_action( 'wp_ajax_custom_loadmore_speeches', 'custom_loadmore_speeches' );
add_action( 'wp_ajax_nopriv_custom_loadmore_speeches', 'custom_loadmore_speeches' );


function custom_post_type_navigation( $args = array() ){
	$cpt = isset($args['custom_post_type']) ? $args['custom_post_type'] : get_post_type(); 
	$current_page = (isset($_GET['_page']) and absint($_GET['_page'])) ? absint($_GET['_page']) : 1;
	if( $args['max_num_pages'] > 1 ):

		$link = get_post_type_archive_link( $cpt );
		if( 1 == $current_page ){
			$older_posts_link = add_query_arg(['_page' => $current_page + 1]); 
		}
		if( 1 < $current_page ){
			// remove the _page param to be replaced with the new values
			remove_query_arg('_page', false);
			$older_posts_link = add_query_arg(['_page' => $current_page + 1]); 
			if( 1 == ($current_page - 1) ){
				$newer_posts_link = remove_query_arg('_page', false); 
			}
			else {
				$newer_posts_link = add_query_arg(['_page' => $current_page - 1]); 
			}
		}
		?>
		<nav class="navigation posts-navigation" role="navigation" aria-label="Posts">
			<h2 class="screen-reader-text">Posts navigation</h2>
			<div class="nav-links">
				<?php if( $current_page < $args['max_num_pages'] ): ?>
					<div class="nav-previous">
						<a href="<?php echo site_url($older_posts_link) ?>">Older posts</a>
					</div>
				<?php endif; ?>
				<?php if( 1 < $current_page ): ?>
					<div class="nav-next">
						<a href="<?php echo site_url($newer_posts_link) ?>">Newer posts</a>
					</div>
				<?php endif; ?>
			</div>
		</nav>
		
		<?php 
	endif;
}


// loading resources documents
function loadResources(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];

	$template_grid = get_template_directory().'/template-parts/content-post-resources.php';
	$template_list = get_template_directory().'/template-parts/content-post-resources-list.php';
	
	$args = [   
		'post_type' => $postType,
		'post_status' => 'publish',
		'numberposts'   => $posts_per_page,
        'order'			=> 'DESC',		
		'paged'   		=> $paged,
		'posts_per_page' => $posts_per_page      
	];

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadResources', 'loadResources' );
add_action( 'wp_ajax_nopriv_loadResources', 'loadResources' );


// loading events
function loadEvents(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];
	$event_date = $_REQUEST['date'];
	$date_formatted = str_replace('-', '', $event_date);
	$paginate = $_REQUEST['isPaginate'];

	$template_grid = get_template_directory().'/template-parts/content-post-events.php';
	$template_list = get_template_directory().'/template-parts/content-post-events-list.php';

	if( $paginate ) {
		if( $posts_per_page % 2 == 0 ) {
			$posts_per_page = $posts_per_page;
		} else {
			$posts_per_page = $posts_per_page + 1;
		}
	}	
	
	$args = [   
		'post_type' 		=> $postType,
		'post_status' 		=> 'publish',
		'numberposts'   	=> $posts_per_page,
		'paged'   			=> $paged,
		'posts_per_page' 	=> $posts_per_page,
		'meta_key'			=> 'event_date',
		'orderby'			=> 'meta_value_num',
		'order'				=> 'ASC',
		'meta_query'        => array(
			'relation'  => 'AND',
			array(
				'key'       => 'event_date',
				'compare'   => 'EXIST'
			),
			array(
				'relation'  => 'OR',
				array(
					'key'       => 'exclude_in_archive',
					'compare'   => '!=',
					'value'     => 1,
				),
				array(
					'key'       => 'exclude_in_archive',
					'compare'   => 'NOT EXISTS',
				)
			)
		)      
	];

	if( $date_formatted ) {
		$args = [   
			'post_type' 		=> $postType,
			'post_status' 		=> 'publish',
			'numberposts'   	=> $posts_per_page,
			'paged'   			=> $paged,
			'posts_per_page' 	=> $posts_per_page,
			'meta_key'			=> 'event_date',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'ASC',
			'meta_query'		=> array(
				array(
					'key'      => 'event_date',
					'compare'  => 'REGEXP',
					'value'    => $date_formatted . '[0-9]{2}',
				)
			)
		];
	}

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadEvents', 'loadEvents' );
add_action( 'wp_ajax_nopriv_loadEvents', 'loadEvents' );


/**
 * Load Search Companies Filter/Search
 */
function loadCards(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];

	$template_grid = get_template_directory().'/template-parts/content-post-cards.php';
	$template_list = get_template_directory().'/template-parts/content-post-cards-list.php';
	
	$args = [   
		'post_type' 	 => $postType,
		'post_status' 	 => 'publish',
		'numberposts'    => $posts_per_page,
        'order'			 => 'DESC',		
		'paged'   		 => $paged,
		'posts_per_page' => $posts_per_page       
	];

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadCards', 'loadCards' );
add_action( 'wp_ajax_nopriv_loadCards', 'loadCards' ); 

function loadGallery() {
	$offset = $_REQUEST['offset'];
	$image_ids = $_REQUEST['ids'];
	$image_ids = explode(',', $image_ids);
	$count = count($image_ids);
	$ids = array_slice( $image_ids, $offset, 8 );
	$images = array();
	$size = '452X458';
	$limit = $offset + 8;
	$output = array();
	$max = false;
	$error = false;

	if( $ids ) {
		foreach( $ids as $id ) {
			$images[] = wp_get_attachment_image_src( $id, $size );
		}
	}
	else {
		$error = true;
	}

	if( $limit >= $count ) {
		$max = true;
	}

	$output = array(
		"max" 		=> $max,
		"images"	=> $images,
		"error"		=> $error
	);

	echo json_encode($output);
	exit;
}
add_action( 'wp_ajax_loadGallery', 'loadGallery' );
add_action( 'wp_ajax_nopriv_loadGallery', 'loadGallery' ); 

/**
 * Load Research in Cards
 */
function loadNewResearch(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];

	$template_grid = get_template_directory().'/template-parts/content-post-research-cards.php';
	$template_list = get_template_directory().'/template-parts/content-post-research-list.php';
	
	$args = array (
		'post_type'      => $postType,
		'post_status'    => 'publish',
		'orderby'        => 'publish_date',
		'order'          => 'DESC',
		'posts_per_page' => $posts_per_page,
		'paged'			 => $paged,
		'post_parent'    => 0,
		'meta_query'     => array(
			'relation'  => 'OR',
			array(
				'key'       => 'exclude_in_archive',
				'compare'   => '!=',
				'value'     => 1,
			),
			array(
				'key'       => 'exclude_in_archive',
				'compare'   => 'NOT EXISTS',
			)
		)
	);

	$args2_bool = false;

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];

			if( $tax_name == 'art_form' ) {
				$args2_bool = true;
			}
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}

	if( $args2_bool ) {
		$args2 = $args;

		$args2['tax_query'][] = array(
			'taxonomy' => 'art_form',
			'field' => 'slug',
			'operator' => 'NOT IN',
			'terms' => array('all-artforms-multi-artform')
		);

		$first_args = $args2;
		$first_args['fields'] = 'ids';
		$first_args['posts_per_page'] = -1;
		$first_ids = get_posts( $first_args );
	
		$next_args = $args;
		$next_args['fields'] = 'ids';
		$next_args['post__not_in'] = $first_ids;
		$next_args['posts_per_page'] = -1;
		$next_ids = get_posts( $next_args );
	
		$post_ids = array_merge( $first_ids, $next_ids );
		$args['post__in'] = $post_ids;
		$args['orderby'] = 'post__in';
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadNewResearch', 'loadNewResearch' );
add_action( 'wp_ajax_nopriv_loadNewResearch', 'loadNewResearch' );

/**
 * Load News by Categories
 */
function loadNews(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];
	$columns = isset( $_REQUEST['columns'] ) ? $_REQUEST['columns'] : 4;

	$template_grid = get_template_directory().'/template-parts/content-post-news.php';
	$template_list = get_template_directory().'/template-parts/content-post-news-list.php';
	
	$args = array (
		'post_type'      => $postType,
		'numberposts'    => $posts_per_page,
		'post_status'    => 'publish',
		'orderby'        => 'publish_date',
		'order'          => 'DESC',
		'posts_per_page' => $posts_per_page,
		'paged'			 => $paged,
	);
	
	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadNews', 'loadNews' );
add_action( 'wp_ajax_nopriv_loadNews', 'loadNews' );

/**
 * Load featured news in cards layout
 */
function loadFeaturedNewsCards(){

	$offset = $_REQUEST['offset'];
	$ids = json_decode( $_REQUEST['ids'] );
	$count = count( $ids );
	$limit = $_REQUEST['limit'];
	$posts = array_slice( $ids, $offset, $limit );
	$max = false;

	$template = get_template_directory().'/template-parts/content-featured-news-cards.php';

	ob_start();
	include($template);
	$items = ob_get_contents();
	ob_end_clean();  

	if( ($offset + $limit) >= $count ) {
		$max = true;
	}

	$data = array(
		"count" 	=> $count,
		"items" 	=> trim($items),
		"max" 		=> $max
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadFeaturedNewsCards', 'loadFeaturedNewsCards' );
add_action( 'wp_ajax_nopriv_loadFeaturedNewsCards', 'loadFeaturedNewsCards' );

/**
 * Load Search Applicants Filter/Search
 */
function loadSearchApplicantsCards(){

	$paged = !empty($_REQUEST['pg'])? $_REQUEST['pg'] : 1;
	$postType = $_REQUEST['postType'];
	$filter_criteria = isset($_REQUEST['filter_criteria']) ? $_REQUEST['filter_criteria'] : [];
	$posts_per_page = $_REQUEST['posts_per_page'];
	$app_date = $_REQUEST['date'];
	$date_formatted = str_replace('-', '', $app_date);
	$paginate = $_REQUEST['isPaginate'];

	$template_grid = get_template_directory().'/template-parts/content-search-applicants-grid.php';
	$template_list = get_template_directory().'/template-parts/content-search-applicants-list.php';

	if( $paginate ) {
		if( $posts_per_page % 2 == 0 ) {
			$posts_per_page = $posts_per_page;
		} else {
			$posts_per_page = $posts_per_page + 1;
		}
	}	
	
	$args = [   
		'post_type' 		=> $postType,
		'post_status' 		=> 'publish',
		'numberposts'   	=> $posts_per_page,
		'paged'   			=> $paged,
		'posts_per_page' 	=> $posts_per_page,
		'meta_key'			=> 'application_approved_date',
		'orderby'			=> 'meta_value_num',
		'order'				=> 'ASC',
		'meta_query'        => array(
			'relation'  => 'AND',
			array(
				'key'       => 'application_approved_date',
				'compare'   => 'EXIST'
			)
		)      
	];

	if( $date_formatted ) {
		$args = [   
			'post_type' 		=> $postType,
			'post_status' 		=> 'publish',
			'numberposts'   	=> $posts_per_page,
			'paged'   			=> $paged,
			'posts_per_page' 	=> $posts_per_page,
			'meta_key'			=> 'application_approved_date',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'ASC',
			'meta_query'		=> array(
				array(
					'key'      => 'application_approved_date',
					'compare'  => 'REGEXP',
					'value'    => $date_formatted . '[0-9]{2}',
				)
			)
		];
	}

	if( count($filter_criteria) ){
		$tax_query = [];
		foreach( $filter_criteria as $tax_name => $criteria ){
			$tax_query[] = [
				'taxonomy' => $tax_name,
				'terms' => $criteria,
				'include_children' => true
			];
		}

		$args['tax_query'] = $tax_query;
		if( count($tax_query) > 1 ){
			$args['tax_query']['relation'] = 'AND';
		}

	}

	if(!empty($_REQUEST['filter'])){
		$args['s'] = $_REQUEST['filter'];  
	}
	
	ob_start();
	include($template_grid);
	$grid = ob_get_contents();
	ob_end_clean();  

	ob_start();
	include($template_list);
	$list = ob_get_contents();
	ob_end_clean();  

	$data = array(
		"total" 		=> $totalpost,
		"entries" 		=> trim($grid),
		"entries_list" 	=> trim($list)
	);

	print json_encode($data); 
	exit;  
} 
add_action( 'wp_ajax_loadSearchApplicantsCards', 'loadSearchApplicantsCards' );
add_action( 'wp_ajax_nopriv_loadSearchApplicantsCards', 'loadSearchApplicantsCards' ); 


/**
 * Home content feed get image from banners or featured image
 */
function get_feed_featured_image( $post_id ) {

	$content = get_the_content( false, false, $post_id );
	$blocks = parse_blocks( $content ); 
	
	$image = get_post_thumbnail_id( $post_id );

	if( empty($image) || $image == '' || is_null($image) ) {
		foreach( $blocks as $block ){
			if( $block['blockName'] == 'acf/post-banner' ){
				$image = $block['attrs']['data']['banner_image'];
			} elseif ( $block['blockName'] == 'acf/page-banner' ) {
				$image = $block['attrs']['data']['banner_image'];
			} elseif ( $block['blockName'] == 'acf/page-banner-v2' ) {
				$image = $block['attrs']['data']['banner_image'];
			} elseif ( $block['blockName'] == 'acf/page-banner-v3' ) {
				$image = $block['attrs']['data']['banner_image'];
			} elseif ( $block['blockName'] == 'acf/block-podcast-page-banner' ) {
				$image = $block['attrs']['data']['banner_image'];
			} elseif ( $block['blockName'] == 'acf/page-basic-header' ) {
				$image = $block['attrs']['data']['image'];
			}
		}
	}

	return $image;
}

/**
 * Home content feed load more via ajax
 */
function loadContentFeed() {
	$offset = $_REQUEST['offset'];
	$post_id = $_REQUEST['post_id'];
	$block_id = $_REQUEST['block_id'];
	$limit = 6;
	$max = false;
	$stop = $offset + $limit;
	
	global $post;

	$content = get_the_content( false, false, $post_id );
	$blocks = parse_blocks( $content ); 

	$template_column = get_template_directory().'/template-parts/content-column-content-feed.php';
	$template_featured = get_template_directory().'/template-parts/content-featured-content-feed.php';

	foreach( $blocks as $block ) {
		if( $block['blockName'] == 'acf/home-content-feed-block' && $block['attrs']['id'] == $block_id ) {
			$total = count($block['attrs']['data']);
			$data = array_slice( $block['attrs']['data'], $offset, $limit );

			break;
		}
	}

	ob_start();
	foreach( $data as $item ) {
		$feed_content = $item['content'];
		$feed_layout = $item['layout_style'];
		$page_or_post = $item['page_or_post']; 				

		if ( $page_or_post ) {
			$post = $page_or_post;
			setup_postdata( $post );

			$feed_image = get_feed_featured_image( $post->ID );

			if( $feed_layout == 'full' ) {						
				include($template_featured);
			} else {
				include($template_column);
			}

			wp_reset_postdata();
		}
	}			
	$output = ob_get_contents();
	ob_end_clean(); 

	if( $stop >= $total ) {
		$max = true;
	}

	$array_output = array(
		'count' => $total,
		'items' => trim($output),
		'max'   => $max
	);

	print json_encode($array_output); 
	exit;  
}
add_action( 'wp_ajax_loadContentFeed', 'loadContentFeed' );
add_action( 'wp_ajax_nopriv_loadContentFeed', 'loadContentFeed' ); 