<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Livin
 */

get_header();
$category = get_queried_object();
$paged = !empty($_GET['pg'])? $_GET['pg'] : 1;


// print "<pre>";
// print_r($category);
// print "</pre>";

// $all_post = get_posts(array(
//     'post_type' => array( 'cpt1', 'cpt2', 'cpt3', 'post' ), // all cpt slug name
//     'numberposts' => -1, // number of post
//     'tax_query' => array(
//          array(
//              'taxonomy' => get_query_var( 'taxonomy '), // current tax name
//              'field' => 'id',
//              'terms' => $term->term_id, // current tax_id
//         )
//     )
// );

$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
$args = [   
    'post_type' => ['mental-health',  'news_and_updates', 'podcast','your_stories','events','upcoming-events','in-the-community','in_the_media' ],
    'post_status' => 'publish',
    'orderby' => 'date',
	'order'   => 'DESC',	
    'paged'   => $paged,
	'posts_per_page' => 6        
];

$dateArchive = "Blog";

if(!empty(get_query_var('monthnum')) && !empty(get_query_var('year'))){
    $args['date_query'] =[
        'relation' => 'OR',
        [
            'year'  => get_query_var('year'),
            'monthnum' => get_query_var('monthnum'),				
        ],
    ];

    $monthNum = get_query_var('monthnum');
    $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

    $ym = $monthName.' '.get_query_var('year');
  
    $dateArchive = "Archives for:";
}

else{
    $args['tax_query'] = [
         [
             'taxonomy' => 'category',
             'terms' =>  $category->term_id,
            'include_children' => true 
         ]
    ];    
}

$catnamejm = $category->name;

$catParent = get_terms('category');

$parentCat = [];
$childrenCat = [];
foreach($catParent as $rs){
    if($rs->parent > 0){
        $childrenCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }else{
        $parentCat[] = [
            'term_id' => $rs->term_id,
            'name' => $rs->name
        ];
    }
}
/*
$args = array (
          's' => (!empty($_REQUEST["search"])?$_REQUEST["search"]:''),
          'post_type' => 'post',
          'post_status' =>'publish',
          'cat' => 5,
          'posts_per_page' => 9,
          'paged' => $paged,
          (!empty($_GET["monthnum"])?'monthnum' =>$_GET["monthnum"]:false),
          (!empty($_GET["year"]))?'year' => $_GET["year"]:false),
          'orderby' =>!empty($_GET["orderby"])?$_GET["orderby"]:'date',
        );
		*/


        $template =dirname(__FILE__) .'/template-parts/content-post-types.php';

	ob_start();		
	include($template);
	$var = ob_get_contents();
	ob_end_clean();  

	echo $var;

//get_sidebar();
get_footer();
