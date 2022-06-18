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
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$args = [
    's' => (!empty($_REQUEST["search"])?$_REQUEST["search"]:''),
     'post_type' => ['mental-health',  'news_and_updates', 'podcast','your_stories' ,'events','upcoming-events','in-the-community','in_the_media'],
	'post_status' => 'publish',
	'orderby' => 'date',
	'order'   => 'DESC',	
	'paged'   => $paged,
	'posts_per_page' => 6,
];
$ym ="";
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
$dateArchive = "Blog";

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
